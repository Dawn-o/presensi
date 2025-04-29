<div class="flex flex-col space-y-3">
    @if (auth()->user()->is_admin)
        <x-custom-select 
            name="user_id" 
            :options="$users->pluck('name', 'id')->map(function($name, $id) use ($users) {
                $employeeId = $users->where('id', $id)->first()->employee_id;
                return $name . ' (' . $employeeId . ')';
            })"
            :selectedValue="request('user_id')"
            placeholder="Pilih Karyawan"
            onchange="window.location.href='{{ route('presence.recap') }}?user_id=' + this.value + '&month={{ $month }}&year={{ $year }}&tab={{ request('tab', 'attendance') }}'"
        />
    @endif

    <form action="{{ route('presence.recap') }}" method="GET" class="grid grid-cols-2 gap-2 sm:flex sm:flex-row sm:gap-4">
        @if (request('user_id'))
            <input type="hidden" name="user_id" value="{{ request('user_id') }}">
        @endif
        <input type="hidden" name="tab" value="{{ request('tab', 'attendance') }}">

        <x-custom-select 
            name="month" 
            :options="collect(range(1, 12))->mapWithKeys(function($month) {
                return [$month => Carbon\Carbon::create()->month($month)->translatedFormat('F')];
            })"
            :selectedValue="$month"
            onchange="this.form.submit()"
        />

        <x-custom-select 
            name="year" 
            :options="collect(range(date('Y'), date('Y') - 5))->mapWithKeys(function($year) {
                return [$year => $year];
            })"
            :selectedValue="$year"
            onchange="this.form.submit()"
        />
    </form>
</div>
