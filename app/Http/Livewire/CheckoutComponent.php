<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Exception;
use Livewire\Component;
use Cart;
use Stripe;

class CheckoutComponent extends Component
{
    public $firstname;
    public $lastname;
    public $email;
    public $address;
    public $city;
    public $province;
    public $zipcode;
    public $payment_type;
    public $thankyou;

    public $card_number;
    public $exp_month;
    public $exp_year;
    public $CVC;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'province' => 'required|max:255',
            'zipcode' => 'required|max:255',
            'payment_type' => 'required',
        ]);

        if ($this->payment_type == 'card') {
            $this->validateOnly($fields, [
                'card_number' => 'required|numeric',
                'exp_month' => 'required|numeric',
                'exp_year' => 'required|numeric',
                'CVC' => 'required|numeric',
            ]);
        }
    }

    public function placeOrder()
    {
        $this->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'province' => 'required|max:255',
            'zipcode' => 'required|max:255',
            'payment_type' => 'required|max:255',
        ]);

        if ($this->payment_type == 'card') {
            $this->validate([
                'card_number' => 'required|numeric',
                'exp_month' => 'required|numeric',
                'exp_year' => 'required|numeric',
                'CVC' => 'required|numeric',
            ]);
        }

        $order = new Order();
        $order->subtotal = Cart::subtotal();
        $order->tax = Cart::tax();
        $order->total = Cart::total();
        $order->firstname = $this->firstname;
        $order->lastname = $this->lastname;
        $order->email = $this->email;
        $order->address = $this->address;
        $order->city = $this->city;
        $order->province = $this->province;
        $order->zipcode = $this->zipcode;
        $order->save();

        foreach (Cart::content() as $item) {
            $order_item = new OrderItem();
            $order_item->product_id = $item->model->id;
            $order_item->order_id = $order->id;
            $order_item->price = $item->model->price;
            $order_item->quantity = $item->qty;
            $order_item->save();
        }

        if ($this->payment_type == 'cod') {
            $this->makeTransaction($order->id, 'pending');
            $this->resetCart();
        } else {
            $stripe = Stripe::make(env('STRIPE_KEY'));

            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $this->card_number,
                        'exp_month' => $this->exp_month,
                        'exp_year' => $this->exp_year,
                        'cvc' => $this->CVC,
                    ],
                ]);

                if (!isset($token['id'])) {
                    session()->flash('stripe_error', 'The token couldn\'t be generated');
                    $this->thankyou = 0;
                }

                $customer = $stripe->customers()->create([
                    'name' => $this->firstname . ' ' . $this->lastname,
                    'email' => $this->email,
                    'address' => [
                        'line1' => $this->address,
                        'city' => $this->city,
                        'state' => $this->province,
                        'postal_code' => $this->zipcode,
                    ],
                    'source' => $token['id'],
                ]);

                $charge = $stripe->charges()->create([
                    'customer' => $customer['id'],
                    'currency' => 'USD',
                    'amount' => Cart::total(),
                    'description' => 'Payment for order number '. $order->id,
                ]);

                if ($charge['status'] == 'succeeded') {
                    $this->makeTransaction($order->id, 'approved');
                    $this->resetCart();
                } else {
                    session()->flash('stripe_error', 'Error during transaction');
                    $this->thankyou = 0;
                }
            } catch (Exception $e) {
                session()->flash('stripe_error', $e->getMessage());
                $this->thankyou = 0;
            }
        }
    }

    public function resetCart()
    {
        $this->thankyou = 1;
        Cart::destroy();
    }

    public function makeTransaction($order_id, $status)
    {
        $transaction = new Transaction();
        $transaction->order_id = $order_id;
        $transaction->type = $this->payment_type;
        $transaction->status = $status;
        $transaction->save();
    }

    public function verifyForCheckout()
    {
        if ($this->thankyou) {
            return redirect()->route('shop.thank-you');
        } elseif (Cart::count() == 0) {
            return redirect()->route('shop.cart');
        }
    }

    public function render()
    {
        $this->verifyForCheckout();
        return view('livewire.checkout-component');
    }
}
