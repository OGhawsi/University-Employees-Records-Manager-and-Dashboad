
<table>
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Father Name</th>
        <th>Grandfather Name</th>
        <th>نوه</th>
        <th>کورني نوم</th>
        <th>د پلار نوم</th>
        <th>د نیکه نوم</th>

        {{-- address --}}
        address and contact info
        <th>Contact No</th>
        <th>Email</th>
        <th>Province</th>
        <th>Street Address</th>

        <th>Tazkir No</th>
        <th>Passport No</th>
        <th>Gender</th>
        <th>Marital Status</th>
        <th>Date of Birth</th>
        <th>Nationality</th>
        <th>Native Language</th>
        <th>Other Languages</th>
        <th>Employee Status</th>
    {{-- degree ralted --}}
        <th>Study Field/Department</th>
        <th>Faculty</th>
        <th>University</th>
        <th>Country</th>
        <th>Degree</th>
        <th>Start Date</th>
        <th>Graduation Date</th>

        <th>Current Rank</th>


  
    </tr>
    </thead>
    <tbody>
    @foreach($employees as $emp)
        <tr>
            <td>{{ $emp->first_name_english }}</td>
            <td>{{ $emp->last_name_english }}</td>
            <td>{{ $emp->father_name_english }}</td>
            <td>{{ $emp->grandfather_name_english }}</td>
            <td>{{ $emp->first_name }}</td>
            <td>{{ $emp->last_name }}</td>
            <td>{{ $emp->father_name }}</td>
            <td>{{ $emp->grandfather_name }}</td>
            
            {{-- address --}}
            @foreach ($emp->addresses as $emp)
                <td>{{ $emp->contact_no }}</td>
                <td>{{ $emp->email }}</td>
                <td>{{ $emp->province_english }}</td>
                <td>
                @if ($emp->address_type == 1 )
                        Permanent Address
                @elseif ($emp->address_type == 2)
                        Current Address
                @endif
                <td>{{ $emp->street_address_english }}</td>
                @break
            @endforeach
            <td>{{ $emp->id_tazkira }}</td>
            <td>{{ $emp->passport_no }}</td>
            {{-- gender --}}
            <td>
                @if ($emp->gender === 1)
                        Male
                    @elseif ($emp->gender === 2)
                        Female
                    @else 
                        Other
                @endif
            </td>
            {{-- Marital Status --}}
            <td>
                @if ($emp->marital_status === 1)
                        Single
                    @elseif ($emp->marital_status === 2)
                        Married
                    @else 
                        Divorced
                @endif
            </td>
            <td> {{$emp->date_of_birth}}</td>
            <td> {{$emp->nationality_english}}</td>
            <td> {{$emp->native_language}}</td>
            <td> 
                @if ($emp->other_languages)
                    @foreach ($emp->other_languages as $item)
                        {{$item}} , 
                    @endforeach
                @else
                    NULL
                @endif
            </td>
            <td>
                @if ($emp->status === 1)
                        Available
                    @elseif ($emp->gender === 2)
                        Working Outside
                    @else 
                        Studying
                @endif
            </td>
            {{-- degree related --}}
            @if ($emp->degrees)
                @foreach ($emp->degrees as $item)
                    <td>{{$item->study_field_english}}</td>
                    <td>{{$item->faculty_english}}</td>
                    <td>{{$item->university_english}}</td>
                    <td>{{$item->country_english}}</td>
                    <td>
                        @if ($item->degree_name == 1)
                                Bachelor
                            @elseif($item->degree_name == 2)
                                Masters
                            @else
                                PhD
                        @endif
                    </td>
                    <td>{{$item->start_date}}</td>
                    <td>{{$item->graduation_date}}</td>
                    
                    @break
                @endforeach
            @endif
            {{-- rank --}}

            @if ($emp->ranks)
                @foreach ($emp->ranks as $item)
                    <td> {{$item->name_english}} </td>
                @endforeach
            @endif
          


        </tr>
    @endforeach
    </tbody>
</table>