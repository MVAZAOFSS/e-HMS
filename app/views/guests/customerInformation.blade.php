<div class="well well-transparent">
    <table class="table">
        @foreach($detail as $row)
        <tr><td>First Name:  {{$row->firstname}}</td></tr>
        <tr><td>Last Name :   {{$row->lastname}}</td></tr>
        <tr><td>Surname   :   {{$row->surname}}</td></tr>
        <tr><td>Sex       :   {{$row->sex}} </td></tr>
        <tr><td>Nationality:  {{$row->nationality}} </td></tr>
        <tr><td>Country    :   {{$row->country}} </td></tr>
        <tr><td>Professional:   {{$row->professional}}</td></tr>
        <tr><td>Children   :    {{$row->children}} </td></tr>
        <tr><td><h5 class="text-primary">Contact Information</h5> </td></tr>
        <tr><td>Address    :  {{$row->address}} </td></tr>
        <tr><td>Fax        :  {{$row->fax}} </td></tr>
        <tr><td>Mobile No.  :  {{$row->mobile}}</td></tr>
        <tr><td>Email       :  {{$row->email}} </td></tr>
        <tr><td><h5 class="text-primary">FROM </h5></td></tr>
        <tr><td>Arrival From : {{$row->arrival_from}} </td></tr>
        <tr><td>Destination To: {{$row->destination_to}} </td></tr>
        <tr><td><h5 class="text-primary">Cost Paid</h5></td></tr>
        <tr><td>Pre-paid Cost : {{$row->pre_paidcost}}</td></tr>
        <tr><td><h5 class="text-primary">Others</h5></td></tr>
        <tr><td>Room Reserved :  {{Room::find($row->room_number)->name}}</td></tr>
        @endforeach
    </table>

</div>