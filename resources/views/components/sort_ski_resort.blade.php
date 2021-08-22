<div class="flex flex-col sm:flex-row">
    <span class="mx-2 my-auto text-md">
        スキー場ソート
    </span>
    <select name="ski_resort" id="ski_resort" class="text-sm ">
        <option value="0" @if (\Request::get('ski_resort') == '0') selected @endif>
            全て
        </option>
        @foreach ($ski_resorts as $ski_resort)
            <option value="{{ $ski_resort->id }}" @if (\Request::get('ski_resort') == $ski_resort->id) selected @endif>
                {{ $ski_resort->name }}
            </option>
        @endforeach
    </select>
</div>

