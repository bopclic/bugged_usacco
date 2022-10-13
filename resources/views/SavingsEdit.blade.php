<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Savings Edit') }}
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


                <form action="{{url('update/'.$savings->id)}}" method="post">
                    @csrf
                    <!-- <input type="text" name="transaction" placeholder="Transaction" value="{{$savings->transaction}}"> -->
                    <select name="transaction" id="">
                        @foreach($transactions as $trans)
                        <option value="{{$trans->type}}">{{$trans->type}}</option>

                        @endforeach
                    </select>
                    <input type="text" name="amount" placeholder="Amount" value="{{$savings->amount}}">
                    <button type="submit">Update</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>