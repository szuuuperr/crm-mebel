<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function createUser(): User
    {
        return User::create([
            'name' => 'Admin',
            'email' => 'admin@crm.test',
            'password' => bcrypt('password'),
        ]);
    }

    protected function createCompletedOrder(string $nomorFaktur): Order
    {
        $user = $this->createUser();
        $customer = Customer::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'telepon' => '08123456789',
        ]);

        return Order::create([
            'nomor_faktur' => $nomorFaktur,
            'customer_id' => $customer->id,
            'user_id' => $user->id,
            'tanggal_pesanan' => now(),
            'subtotal' => 500000,
            'pajak' => 0,
            'ongkir' => 0,
            'diskon' => 0,
            'total' => 500000,
            'status' => 'selesai',
        ]);
    }

    public function test_public_review_page_for_order_shows()
    {
        $this->createCompletedOrder('INV-0001');

        $response = $this->get('/review/INV-0001');

        $response->assertStatus(200);
        $response->assertSee('Budi Santoso');
        $response->assertSee('Beri Penilaian');
    }

    public function test_unavailable_when_order_not_completed()
    {
        $user = $this->createUser();
        $customer = Customer::create(['nama' => 'Budi']);

        Order::create([
            'nomor_faktur' => 'INV-0002',
            'customer_id' => $customer->id,
            'user_id' => $user->id,
            'tanggal_pesanan' => now(),
            'status' => 'dalam_produksi',
        ]);

        $this->get('/review/INV-0002')->assertStatus(404);
    }

    public function test_submit_review_updates_order_and_redirects_to_done()
    {
        $this->createCompletedOrder('INV-0003');

        $response = $this->post('/review/INV-0003', [
            'rating' => 5,
            'keluhan_masukan' => 'Produk sangat bagus dan sesuai harapan.',
        ]);

        $response->assertRedirect('/review/INV-0003/done');

        $this->assertDatabaseHas('orders', [
            'nomor_faktur' => 'INV-0003',
            'rating' => 5,
            'keluhan_masukan' => 'Produk sangat bagus dan sesuai harapan.',
        ]);
    }

    public function test_submit_validation_rejects_missing_rating()
    {
        $this->createCompletedOrder('INV-0004');

        $response = $this->from('/review/INV-0004')->post('/review/INV-0004', [
            'keluhan_masukan' => 'Produk bagus sekali',
        ]);

        $response->assertSessionHasErrors('rating');
    }

    public function test_already_reviewed_redirects_to_done()
    {
        $order = $this->createCompletedOrder('INV-0005');
        $order->update(['rating' => 4, 'keluhan_masukan' => 'Sudah pernah review.']);

        $this->get('/review/INV-0005')->assertRedirect('/review/INV-0005/done');
    }
}
