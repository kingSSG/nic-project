<div class="form-group">
    <label for="District">District:</label>
    <select name="district" id="district" required class="form-control selectpicker">
        <option value=""> Select District </option>
        @foreach ($districts as $district)
            <option value="{{ $district->districtcd }}">{{ $district->district }}</option>
        @endforeach
    </select>
    @error('district')
        <span>{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <label for="Subdivision">Subdivision:</label>
    <select name="subdivision" id="subdivision" required class="form-control selectpicker">
        <option value="">Select Subdivision</option>

    </select>
    @error('subdivision')
        <span>{{ $message }}</span><br>
    @enderror
</div>
<div class="form-group">
    <label for="municipality">Municipality:</label>
    <select name="municipality" id="municipality" required class="form-control selectpicker">

        <option value="">Select Municipality</option>
    </select>
    @error('municipality')
        <span>{{ $message }}</span><br>
    @enderror

</div>
<div class="form-group">
    <label for="Months">Reporting Year</label>
    <select name="year" id="year" required class="form-control selectpicker">
        <option value="">Select Year</option>
        @foreach ($years as $year)
            <option value="{{ $year->year }}">{{ $year->year }}</option>
        @endforeach
    </select>
    @error('year')
        <span>{{ $message }}</span><br>
    @enderror

</div>
<div class="form-group">
    <label for="Months">Reporting Month</label>
    <select name="month" id="month" required class="form-control selectpicker">
        <option value="">Select Month</option>
        @foreach ($months as $month)
            <option value="{{ $month->month }}">{{ $month->month_name }}</option>
        @endforeach
    </select>
    @error('month')
        <span>{{ $message }}</span><br>
    @enderror

</div>