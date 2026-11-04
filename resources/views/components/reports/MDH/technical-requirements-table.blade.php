  @props(['rows', 'reportData'])

  <div class="section-title section-title-underline">
      المتطلبات الفنية للمركبات المعدلة
  </div>

  <table class="modified-checklist">

      <thead>

          <tr>
              <th class="no-col">م</th>
              <th class="item-col">البند</th>
              <th class="status-col">Pass</th>
              <th class="status-col">Fail</th>
              <th class="status-col">N/A</th>
          </tr>

      </thead>

      <tbody>

          @foreach ($rows as $row)
              <tr>

                  <td class="item-number">
                      {{ $row['no'] }}
                  </td>
                  <td class="item-text">
                      {{ $row['text'] }}
                  </td>


                  <td class="checkbox-cell">
                      {{ $row['result'] === \App\Enums\InspectionResult::Pass ? '☒' : '☐' }}
                  </td>
                  <td class="checkbox-cell">
                      {{ $row['result'] === \App\Enums\InspectionResult::Fail ? '☒' : '☐' }}
                  </td>
                  <td class="checkbox-cell">
                      {{ $row['result'] === \App\Enums\InspectionResult::NotApplicable ? '☒' : '☐' }}
                  </td>
              </tr>

              <tr class="notes-row">
                  <td class="notes-title">
                      ملاحظات
                  </td>

                  <td colspan="4">
                      {{ $row['remarks'] }}
                  </td>


              </tr>
          @endforeach

      </tbody>

  </table>
