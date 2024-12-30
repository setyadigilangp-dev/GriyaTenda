public function checkout(Request $request)
{
    $user_id = Auth::id();

    try {
        // Ambil keranjang user
        $cart = Cart::with('barang')->where('user_id', $user_id)->get();
        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong.');
        }

        // Validasi input
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'metode_bayar_id' => 'required|exists:metode_bayar,id',
        ]);

        // Ambil tanggal dari request
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));

        // Hitung total harga sewa
        $totalDays = max($endDate->diffInDays($startDate), 1); // Minimal 1 hari
        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalPrice += $item->barang->harga_sewa * $item->jumlah * $totalDays;
        }

        // Generate kode unik untuk rentals_id
        $rent_id = $this->generateRentId(); // Anda dapat membuat fungsi ini
        $kode_rent_id = "R-" . $rent_id;

        // Total dengan kode unik
        $totalWithCode = $totalPrice + $rent_id;

        // Simpan data ke tabel rentals
        $rental = Rental::create([
            'id' => $kode_rent_id,
            'user_id' => $user_id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'metode_bayar_id' => $request->metode_bayar_id,
            'total' => $totalWithCode,
        ]);

        // Simpan data ke tabel rentals_items
        foreach ($cart as $item) {
            RentalItems::create([
                'rentals_id' => $kode_rent_id,
                'products_id' => $item->product_id,
                'jumlah' => $item->jumlah,
                'harga' => $item->barang->harga_sewa * $item->jumlah * $totalDays,
            ]);

            // Kurangi stok produk
            $item->barang->decrement('stok', $item->jumlah);
        }

        // Hapus keranjang setelah checkout
        Cart::where('user_id', $user_id)->delete();

        return redirect()->back()->with('success', 'Checkout berhasil!');
    } catch (\Exception $e) {
        Log::error("Checkout error: " . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan saat checkout. Silakan coba lagi.');
    }
}

