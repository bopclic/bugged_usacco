<h1>Admin Dashboard</h1>
<a href="{{route('admin.logout')}}">LOGOUT</a>

<h1>Quick Stats</h1>
<p>Active users</p>
{{$users_no}}
<p>Monthly new users</p>
<p>{{$month_user}}</p>
<p>Total savings amount</p>
<p>{{$saving_balance}}</p>
<p>Open Loans amount</p>
<p>{{$loan_balance}}</p>
<p>Open Loans</p>
<p>{{$open_loans}}</p>
<p>Defaulted Loans</p>
<p>{{$def_loans}}</p>
<p>Restructured loans</p>
<p>{{$struct_loans}}</p>
<p>Fully Paid Loans</p>
<p>{{$paid_loans}}</p>





<h1>Accounts</h1>
<button>Create New User</button>
<button>Deleted Users</button>
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Registration fee</th>
        <th>Saving Balance</th>
        <th>Loan Balance</th>
        <th>Created At</th>
        <th>Action</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td></td>
        <td>{{$user->saving_balance}}</td>
        <td>{{$user->loan_balance}}</td>
        <td>{{$user->created_at}}</td>
        <td>
            <button>VIEW</button>
            <button>EDIT</button>
            <button>DELETE</button>
        </td>
    </tr>
    @endforeach
</table>

<h1>Savings</h1>
<form action="{{route('savings.deposit')}}" method="post">
    @csrf
    <input type="number" placeholder="amount" name="amount">
    <select name="email" id="">
        @foreach($users as $user)
        <option value="{{$user->email}}">{{$user->email}}</option>
        @endforeach
    </select>
    <button type="submit">Initiate new deposit</button>
</form>
<form action="{{route('savings.deposit')}}" method="post">
    @csrf
    <input type="number" placeholder="amount" name="amount">

    <input type="number" placeholder="withdraw fees" name="amount">
    <select name="email" id="">
        @foreach($users as $user)
        <option value="{{$user->email}}">{{$user->email}}</option>
        @endforeach
    </select>
    <button type="submit">Initiate new withdraw</button>
</form>
<form action="{{route('savings.deposit')}}" method="post">
    @csrf
    <input type="number" placeholder="percentage interest" name="amount">
    <select name="email" id="">
        @foreach($users as $user)
        <option value="{{$user->email}}">{{$user->email}}</option>
        @endforeach
    </select>
    <select name="" id="">
        <option value="">Issue to All</option>
    </select>
    <button type="submit">Issue Savings Interest</button>
</form>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Savings Balance</th>
        <th>Last Transaction</th>
        <th>Action</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->saving_balance}}</td>
        <td>{{$user->last_transaction}}:{{$user->last_amount}}</td>
        <td>
            <button>VIEW</button>
        </td>
    </tr>
    @endforeach
</table>

<h1>Loans</h1>
<form action="{{route('loan.create')}}" method="post">
    @csrf

    <label for="">Borrower</label>
    <select name="email">
        <option value="">--Choose--</option>
        @foreach($users as $user)

        <option value="{{$user->email}}">{{$user->email}} (Savings:{{$user->loan_balance}} | Loans:{{$user->saving_balance}})</option>
        @endforeach
    </select><br><br>

    <label for="">Principal Amount</label>
    <input type="number" name="principal" placeholder="Principal Amount"><br><br>

    <label for="">% Interest rate per annum</label>
    <input type="number" placeholder="Interest rate" name="interest"><br><br>
    <label for="">Loan Period/Duration</label>
    <input type="number" name="maturity" placeholder="Loan period">
    <select name="" id="">
        <option value="">Months</option>
        <option value="">Years</option>
    </select>
    <br><br>

    <label for="">Loan fee</label>
    <input type="number" placeholder="loan fee" name="loan_fee"><br><br>

    <!-- <label for="">Loan fee type</label>
    <select name="" id="" onchange="loanFee(this);">
        <option value="">--choose--</option>
        <option value="Flat Rate Additional">Flat Rate Additional</option>
        <option value="Flat Rate Deductable">Flat Rate Deductable</option>
        <option value="Percentage Additional">Percentage Additional</option>
        <option value="Percentage Deductable">Percentage Deductable</option>
    </select><br><br>

    <div id="flatFee" style="display: none;">
        <label for="">Loan fee</label>
        <input type="number" name="loan_fee" placeholder="Amount"><br><br>
    </div>
    <div id="centageFee" style="display: none;">
        <label for="">Loan fee</label>
        <input type="number" name="loan_fee" placeholder="Percentage"><br><br>
    </div> -->

    <!-- <label for="">Monthly Payments</label>
    <input type="text"><br><br> -->
    <label for="">First Payment Date</label>
    <input type="date" placeholder="months" name="date"><br><br>







    <label for="">Reason</label><br>
    <textarea name="reason" id="" cols="30" rows="10"></textarea><br><br>

    <label for="">Guarantor</label>
    <select name="guarantor">
        <option value="">--Choose--</option>
        @foreach($users as $user)

        <option value="{{$user->email}}">{{$user->email}} (Savings:{{$user->loan_balance}} | Loans:{{$user->saving_balance}})</option>
        @endforeach
    </select>



    <!-- <label for="">Interest type</label>
    <select name="" id="" onchange="interestType(this);">
        <option value="">--choose--</option>
        <option value="Flat Rate">Flat Rate</option>
        <option value="Principal based Simple Interest">Principal based Simple Interest</option>
        <option value="Reducing Balance based Simple Interest">Reducing Balance based Simple Interest</option>
        <option value="Principal based Compund Interest">Principal based Compund Interest</option>
        <option value="Reducing Balance based Compund Interest">Reducing Balance based Compund Interest</option>
    </select><br><br>

    <div id="flatRate" style="display: none;">
        <label for="">Interest amount</label>
        <input type="number" name="interest" placeholder="Amount"><br><br>
    </div>

    <div id="centageRate" style="display: none;">
        <label for="">Interest Percentage</label>
        <input type="number" name="interest" placeholder="Percentage"><br><br>
    </div> -->









    <script>
        function loanFee(that) {
            if (that.value == "Flat Rate Additional" || that.value == "Flat Rate Deductable") {
                document.getElementById("flatFee").style.display = "block";
            } else {
                document.getElementById("flatFee").style.display = "none";
            }

            if (that.value == "Percentage Additional" || that.value == "Percentage Deductable") {
                document.getElementById("centageFee").style.display = "block";
            } else {
                document.getElementById("centageFee").style.display = "none";
            }
        }

        function interestType(that) {
            if (that.value == "Flat Rate") {
                document.getElementById("flatRate").style.display = "block";
            } else {
                document.getElementById("flatRate").style.display = "none";
            }

            if (that.value == "Principal based Simple Interest" || that.value == "Reducing Balance based Simple Interest" || that.value == "Principal based Compund Interest" || that.value == "Reducing Balance based Compund Interest") {
                document.getElementById("centageRate").style.display = "block";
            } else {
                document.getElementById("centageRate").style.display = "none";
            }
        }

        function penaltyType(that) {
            if (that.value == "Flat Rate") {
                document.getElementById("flatPenalty").style.display = "block";
            } else {
                document.getElementById("flatPenalty").style.display = "none";
            }
            if (that.value == "Percentage") {
                document.getElementById("centagePenalty").style.display = "block";
            } else {
                document.getElementById("centagePenalty").style.display = "none";
            }
        }
    </script>









    <br><br>

    <button type="submit">Create new loan</button>

    <button>Repay Loan</button>
    <button>Restructure Loan</button>
</form>

<br><br>
<table>
    <tr>
        <th>User</th>
        <th>Principal</th>
        <th>loan fee</th>
        <th>received amount</th>
        <th>interest</th>
        <th>Status</th>

        <th>monthly payment</th>
        <th>reason</th>
        <th>guarantee</th>
        <th>loan balance</th>
        <th>Disburse date</th>
        <th>Maturity</th>
    </tr>
    @foreach($loans as $loan)
    <tr>
        <td>{{$loan->user_id}}</td>
        <td>{{$loan->principal}}</td>
        <td>{{$loan->loan_fee}}</td>
        <td>{{$loan->received_amount}}</td>
        <td>{{$loan->interest}}</td>
        <td>
            {{$loan->status}}
        </td>


        <td>{{$loan->monthly_payment}}</td>
        <td>{{$loan->reason}}</td>
        <td>{{$loan->guarantee}}</td>
        <td>{{$loan->loan_balance}}</td>
        <td>{{$loan->created_at->diffForHumans()}}</td>
        <td>{{$loan->maturity_date}}</td>
    </tr>
    @endforeach
</table>
<br><br>


<h1>Loan Calculator</h1>
<h1>Cash Flow Analysis</h1>