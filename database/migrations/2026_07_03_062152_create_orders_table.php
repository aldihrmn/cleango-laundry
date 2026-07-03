public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();

        $table->foreignId('customer_id')->constrained()->onDelete('cascade');
        $table->foreignId('service_id')->constrained()->onDelete('cascade');

        $table->integer('qty');
        $table->decimal('total_price', 10, 2);

        $table->string('status')->default('proses');

        $table->timestamps();
    });
}
