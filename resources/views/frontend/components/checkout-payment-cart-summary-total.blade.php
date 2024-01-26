<section class="row summary-total">
    <section class="col-6">
    </section>
    <section class="col-1">
    </section>
    <section class="col-3 summary-label">
        Sub Total
    </section>
    <section class="col-2 text-right">
        Rs. {{$order->total_amount}}
    </section>
</section>
<section class="row summary-total">
    <section class="col-6">
    </section>
    <section class="col-1">
    </section>
    <section class="col-3 summary-label">
        Shipping Charge
    </section>
    <section class="col-2 text-right">
        + Rs. {{$order->shipping_charge}}
    </section>
</section>
<section class="row summary-total">
    <section class="col-6">
    </section>
    <section class="col-1">
    </section>
    <section class="col-3 summary-label">
        Discount
    </section>
    <section class="col-2 text-right">
        - Rs. {{$order->discount}}
    </section>
</section>
<section class="row summary-total">
    <section class="col-6">
    </section>
    <section class="col-1">
    </section>
    <section class="col-3 summary-label">
        Total
    </section>
    <section class="col-2 text-right summary-label">
        Rs. {{$order->payable_amount}}
    </section>
</section>
