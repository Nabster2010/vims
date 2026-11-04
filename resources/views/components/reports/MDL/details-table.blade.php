<div class="section-title">
    Technical Requirement for Modified Vehicle
</div>


<table class="modified-english-table">
    <thead>

        <tr>
            <th class="en-no">
                S/N
            </th>

            <th class="en-item">
                Item
            </th>

            <th class="en-ref">
                Ref.
            </th>

            <th class="en-modified">
                Modified
                <br>
                Yes / No
            </th>

            <th class="en-check">
                How to Check
            </th>

            <th class="en-requirements">
                Requirements
            </th>

            <th class="en-result">
                Result
            </th>

            <th class="en-final ">
                Final
            </th>

        </tr>

    </thead>

    <tbody>

        @foreach ($rows as $row)
            <tr>

                <td>{{ $row['sn'] }}</td>

                <td class="text-left">
                    {{ $row['item'] }}
                </td>

                <td>
                    <table class="requirements-table">

                        @foreach ($row['ref'] as $reference)
                            <tr>
                                <td>
                                    {{ $reference }}
                                </td>

                            </tr>
                        @endforeach

                    </table>
                </td>

                <td>
                    {{ $row['is_modified'] ? 'YES' : 'NO' }}
                </td>

                <td class="text-left">
                    {!! $row['check'] !!}
                </td>

                <td class="requirements-cell">

                    <table class="requirements-table">

                        @foreach ($row['requirements'] as $requirement)
                            <tr>
                                <td>
                                    {{ $requirement }}
                                </td>

                            </tr>
                        @endforeach

                    </table>

                </td>



                <td class="result-cell {{ $row['result'] === \App\Enums\InspectionResult::Fail ? 'fail-result' : '' }}">
                    {{ $row['result'] }}
                </td>
                <td class="result-cell {{ $row['result'] === \App\Enums\InspectionResult::Fail ? 'fail-result' : '' }}">
                    {{ $row['result'] }}
                </td>

            </tr>
        @endforeach

    </tbody>

</table>
