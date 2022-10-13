<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1>Hi ...{{Auth::User()->name}}</h1>
                <!-- <x-jet-welcome /> -->
                <h1>Savings Balance</h1>
                <p>{{$saving_balance}}</p>


                <br>
                <h1>Read Savings Statement User</h1>

                @if($savings->isEmpty())
                <h1>No savings available</h1>
                @else
                <table>
                    <tr>

                        <th>Date</th>
                        <th>Status</th>
                        <th>Amount</th>

                    </tr>
                    @foreach($savings as $saving)

                    <tr>

                        <td>{{$saving->created_at}}</td>
                        <td>{{$saving->transaction}}</td>
                        <td>{{$saving->amount}}</td>

                    </tr>

                    @endforeach
                    @endif

                </table>
                <br>

                <h1>LOANS</h1>
                <h3>Loan Balance</h3>
                <p>{{$loan_balance}}</p>
                <br>
                <h1>Read Loan Statement</h1>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Principal</th>
                        <th>Loan Fee</th>
                        <th>Interest</th>
                        <th>Duration</th>
                        <th>Maturity Date</th>
                        <th>Guarantee</th>
                        <th>Collateral</th>
                        <th>status</th>
                        <th>Repaid</th>
                        <th>Due</th>
                        <th>Penalty</th>
                        <th>Issuing officer</th>
                    </tr>
                    @foreach($loans as $loan)
                    <tr>
                        <td>{{$loan->created_at}}</td>
                        <td>{{$loan->principal}}</td>
                        <td>{{$loan->loan_fee}}</td>
                        <td>{{$loan->interest}}</td>
                        <td></td>
                        <td>{{$loan->maturity_date}}</td>
                        <td></td>
                        <td></td>
                        <td>{{$loan->status}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </table>





            </div>
        </div>
    </div>
</x-app-layout>