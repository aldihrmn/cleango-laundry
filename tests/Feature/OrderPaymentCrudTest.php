<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderPaymentCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_update_and_delete_order_and_payment(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $orderResponse = $this->post('/orders', [
            'user_id' => $user->id,
            'kode_order' => 'ORD-TEST-001',
            'tanggal_order' => '2026-07-09',
            'status' => 'Menunggu',
            'pickup_type' => 'Antar',
            'estimasi_selesai' => '2026-07-10',
            'total_harga' => 25000,
            'catatan' => 'Dummy test',
        ]);

        $orderResponse->assertRedirect(route('orders.index'));
        $this->assertDatabaseHas('orders', ['kode_order' => 'ORD-TEST-001']);

        $order = Order::where('kode_order', 'ORD-TEST-001')->firstOrFail();

        $paymentResponse = $this->post('/payments', [
            'order_id' => $order->id,
            'metode' => 'Transfer',
            'jumlah' => 25000,
            'status_pembayaran' => 'Pending',
            'tanggal_bayar' => '2026-07-09 10:00:00',
        ]);

        $paymentResponse->assertRedirect(route('payments.index'));
        $this->assertDatabaseHas('payments', ['order_id' => $order->id]);

        $this->put('/orders/' . $order->id, [
            'user_id' => $user->id,
            'kode_order' => 'ORD-TEST-002',
            'tanggal_order' => '2026-07-09',
            'status' => 'Selesai',
            'pickup_type' => 'Jemput',
            'estimasi_selesai' => '2026-07-11',
            'total_harga' => 30000,
            'catatan' => 'Updated test',
        ])->assertRedirect(route('orders.index'));

        $this->assertDatabaseHas('orders', ['kode_order' => 'ORD-TEST-002']);

        $payment = Payment::where('order_id', $order->id)->firstOrFail();

        $this->put('/payments/' . $payment->id, [
            'order_id' => $order->id,
            'metode' => 'QRIS',
            'jumlah' => 30000,
            'status_pembayaran' => 'Lunas',
            'tanggal_bayar' => '2026-07-09 12:00:00',
        ])->assertRedirect(route('payments.index'));

        $this->assertDatabaseHas('payments', ['id' => $payment->id, 'metode' => 'QRIS']);

        $this->delete('/orders/' . $order->id)->assertRedirect(route('orders.index'));

        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
        $this->assertDatabaseMissing('payments', ['id' => $payment->id]);
    }
}
