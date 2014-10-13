<table class="table table-responsive">
    <tr><td>Expenditure Source</td>
     <td><b>{{Expenditure::find($id)->expenditure_name}}</b></td></tr>
    <tr><td>Expenditure Reasons</td>
     <td><b>{{Expenditure::find($id)->expenditure_reasons}}</b></td></tr>
    <tr><td>Date Issued</td>
     <td><b>{{Expenditure::find($id)->date}}</b></td></tr>
    <tr><td>Amount</td>
        <td><b>{{Expenditure::find($id)->cost}}</b></td></tr>
    <tr><td>Issued Name</td>
    <td><b>{{User::find(Expenditure::find($id)->consumed_by)->lastname}} {{User::find(Expenditure::find($id)->consumed_by)->firstname }}</b></td></tr>
</table>