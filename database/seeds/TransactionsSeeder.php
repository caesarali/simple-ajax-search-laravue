<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\Type;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20; $i++) {
            // Random Date
            $year = rand(2018, 2019);
            $month = rand(1, 12);
            $day = rand(1, 28);
            $date = Carbon::create($year,$month ,$day , 0, 0, 0);

            $transaction = Transaction::create([
                'customer_id' => rand(1,5),
                'user_id' => rand(1,2),
                'start_date' => $date->format('Y-m-d'),
                'end_date' => $date->addDays(rand(3,6))->format('Y-m-d'),
                'status' => rand(0,1)
            ]);

            for ($x=0; $x < rand(2,5); $x++) {
                $type = Type::find(rand(1,6));
                $qty = rand(1,5);
                $subtotal = $qty * $type->price;
                $transaction->details()->create([
                    'type_id' => $type->id,
                    'qty' => $qty,
                    'subtotal' => $subtotal
                ]);
            }

            $transaction->update(['amount' => $transaction->details->sum('subtotal')]);
        }
    }
}
