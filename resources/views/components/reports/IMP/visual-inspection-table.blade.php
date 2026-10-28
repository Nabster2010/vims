  <?php
  
  $visualInspection = $inspection->visualInspection->visualItemResults;
  
  $groups = $visualInspection->load('visualItem')->groupBy(fn($result) => $result->visualItem->category);
  
  $leftCategories = ['internal', 'interior', 'safety', 'modern_systems', 'fuel_economy', 'other'];
  
  ?>


  <div class="grid grid-cols-2 gap-6">
      <table class="w-full border border-gray-400 border-collapse text-sm">

          <thead>
              <tr>
                  <th colspan="3" class="border bg-gray-100 p-2 text-lg font-bold">
                      الفحص الداخلي
                  </th>
              </tr>

              <tr>
                  <th class="w-24 border p-2">الحالة</th>
                  <th class="border p-2">البند</th>
                  <th class="w-12 border p-2">م</th>
              </tr>
          <tbody>

              @foreach ($leftCategories as $category)
                  @php
                      $items = $groups[$category] ?? collect();

                      if ($items->isEmpty()) {
                          continue;
                      }
                  @endphp

                  <tr>

                      <td colspan="3" class="bg-gray-100 text-center font-bold border py-2">

                          {{ $items->first()->visualItem->category_ar }}

                      </td>

                  </tr>

                  @foreach ($items as $row)
                      <tr>

                          <td class="border text-center">

                              {{ $row->result }}

                          </td>

                          <td class="border text-right px-2">

                              {{ $row->visualItem->name_ar }}

                          </td>

                          <td class="border text-center">

                              {{ $row->visualItem->sort_order }}

                          </td>

                      </tr>
                  @endforeach
              @endforeach

          </tbody>


      </table>
      <table class="w-full border border-gray-400 border-collapse text-sm">

          <thead>
              <tr>
                  <th colspan="3" class="border bg-gray-100 p-2 text-lg font-bold">
                      الفحص الخارجي
                  </th>
              </tr>

              <tr>
                  <th class="w-24 border p-2">الحالة</th>
                  <th class="border p-2">البند</th>
                  <th class="w-12 border p-2">م</th>
              </tr>
          </thead>

          <tbody>

              @foreach ($groups['external'] ?? [] as $row)
                  <tr>

                      <td class="border text-center h-4">
                          {{ $row->result }}
                      </td>

                      <td class="border text-right px-2">
                          {{ $row->visualItem->name_ar }}
                      </td>

                      <td class="border text-center">
                          {{ $row->visualItem->sort_order }}
                      </td>

                  </tr>
              @endforeach

          </tbody>


      </table>

  </div>
