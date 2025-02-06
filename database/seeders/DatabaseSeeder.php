<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Plai;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Pest\ArchPresets\Custom;

class DatabaseSeeder extends Seeder
{
    /**
         * Seed the application's database.
         */
        public function run(): void
        {
            \App\Models\User::factory()->create([
                'name' => 'Shakeel Ahmad',
                'email' => 'shakeel2717@gmail.com',
                'password' => bcrypt("asdfasdf")
            ]);
    

    
            \App\Models\User::factory()->create([
                'name' => 'Kashif Mukhtar',
                'email' => 'kashifmukhtar349@gmail.com',
                'password' => bcrypt("asdfasdf")
            ]);
    
            \App\Models\User::factory()->create([
                'name' => 'Atif Mukhtar',
                'email' => 'atifmukhtar701@gmail.com',
                'password' => bcrypt("asdfasdf")
            ]);
    
            \App\Models\User::factory()->create([
                'name' => 'Saqib Mukhtar',
                'email' => 'saqibmukhtar51@gmail.com',
                'password' => bcrypt("asdfasdf")
            ]);
    
            \App\Models\User::factory()->create([
                'name' => 'Amir Mukhtar',
                'email' => 'amirmukhtar68@gmail.com',
                'password' => bcrypt("asdfasdf")
            ]);
    
            // \App\Models\Party::factory()->create([
            //     'name' => 'Asan Webs',
            //     'phone' => '1234567890',
            //     'address' => 'AMFiber House, Sector 63, Noida, UP',
            //     'type' => 'customer',
            // ]);
    
            // \App\Models\Party::factory()->create([
            //     'name' => 'Customer Account 2',
            //     'phone' => '1234567890',
            //     'address' => 'AMFiber House, Sector 63, Noida, UP',
            //     'type' => 'customer',
            // ]);
    
            // \App\Models\Party::factory()->create([
            //     'name' => 'Customer Account 3',
            //     'phone' => '1234567890',
            //     'address' => 'AMFiber House, Sector 63, Noida, UP',
            //     'type' => 'customer',
            // ]);
    
            // \App\Models\Party::factory()->create([
            //     'name' => 'Vendor Account 1',
            //     'phone' => '1234567890',
            //     'address' => 'AMFiber House, Sector 63, Noida, UP',
            //     'type' => 'vendor',
            // ]);
    
            // \App\Models\Party::factory()->create([
            //     'name' => 'Vendor Account 2',
            //     'phone' => '1234567890',
            //     'address' => 'AMFiber House, Sector 63, Noida, UP',
            //     'type' => 'vendor',
            // ]);
    
        
    
            // adding plais
            $plai = new Plai();
            $plai->name = 'Single';
            $plai->price = '100';
            $plai->save();
    
            // adding plais
            $plai = new Plai();
            $plai->name = '1.5';
            $plai->price = '120';
            $plai->save();
    
            // adding plais
            $plai = new Plai();
            $plai->name = 'Double';
            $plai->price = '140';
            $plai->save();
    
            // adding plais
            $plai = new Plai();
            $plai->name = 'Color Double';
            $plai->price = '150';
            $plai->save();
    
            // adding plais
            $plai = new Plai();
            $plai->name = '3';
            $plai->price = '210';
            $plai->save();
        }
    
        
    
        // Method to seed payments
        private function seedPayments()
        {
            // Get all customers from the database
            $customers = Customer::all();
    
            // Loop through customers and create payment records
            foreach ($customers as $customer) {
                Payment::create([
                    'customer_id' => $customer->id, // Link payment to a customer
                    'amount' => rand(100, 1000), // Random amount between 100 and 1000
                    'reduction' => rand(0, 100), // Random reduction between 0 and 100
                    'payment_method' => $this->getRandomPaymentMethod(), // Random payment method
                    'reference' => 'Payment for order #' . rand(1, 100), // Random reference
                ]);
            }
        }
        private function getRandomPaymentMethod()
        {
            $methods = ['Cash', 'Bank', 'Mobicash', 'EasyPaisa'];
            return $methods[array_rand($methods)];
        }
    }