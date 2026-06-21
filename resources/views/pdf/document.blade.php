<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>Document Full Details</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            text-transform: uppercase;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }


        .box {
            border: 1px solid #000;
            padding: 8px;
            margin-bottom: 10px;
        }


        .box-title {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 5px;
        }


        table {
            width: 100%;
            border-collapse: collapse;
        }


        table,
        th,
        td {
            border: 1px solid #000;
        }


        th,
        td {
            padding: 5px;
            text-align: center;
        }


        th {
            background: #eee;
        }


        .left {
            text-align: left;
        }
    </style>


</head>


<body>


    <div class="title">
        FULL DOCUMENT DETAILS
    </div>

    <!-- BASIC INFO -->

    <div class="box">
        <div class="box-title">
            Basic Information
        </div>
        <table>
            <tr>
                <td class="left">
                    <b>Importer Name:</b>
                </td>
                <td class="left">
                    {{ $data->importer_name }}
                </td>

                <td class="left">
                    <b>Total Quantity:</b>
                </td>

                <td class="left">
                    {{ $data->total_quantity }}
                    {{ $data->pkgs_code }}
                </td>
            </tr>
            <tr>
                <td class="left">
                    <b>Vessel</b>
                </td>

                <td class="left">
                    {{ $data->vessel }}
                </td>

                <td class="left">
                    <b>BL No</b>
                </td>

                <td class="left">
                    {{ $data->bl_no }}
                </td>
            </tr>

            <tr>
                <td class="left">
                    <b>ROT No</b>
                </td>

                <td class="left">
                    {{ $data->rot_no }}
                </td>

                <td class="left">
                    <b>LC No</b>
                </td>

                <td class="left">
                    {{ $data->lc_number }}
                </td>
            </tr>

            <tr>
                <td class="left">
                    <b>Doc. Received</b>
                </td>

                <td class="left">
                    {{ $data->document_receiver }}
                </td>

                <td class="left">
                    <b>Lc Date</b>
                </td>

                <td class="left">
                    {{ $data->lc_date }}
                </td>
            </tr>

            <tr>
                <td class="left">
                    <b>R No</b>
                </td>

                <td class="left">
                    {{ $data->r_no }}
                </td>

                <td class="left">
                    <b>Assessment Date</b>
                </td>

                <td class="left">
                    {{ $data->assessment_date }}
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td class="left">
                    <b>Delivery Date</b>
                </td>

                <td class="left">
                    {{ $data->delivery_date }}
                </td>
            </tr>
        </table>
    </div>

    <div class="box">
        <div class="box-title">
            Register Details
        </div>
        <table>
            <tr>
                <td class="left">
                    <b>Invoice No</b>
                </td>

                <td class="left">
                    {{ $data->invoice_no }}
                </td>

                <td class="left">
                    <b>Invoice Date</b>
                </td>

                <td class="left">
                    {{ $data->invoice_date }}
                </td>
            </tr>
            <tr>
                <td class="left">
                    <b>Invoice Value</b>
                </td>

                <td class="left">
                    $
                    {{ number_format($data->invoice_value ?? 0, 2) }}
                </td>

                <td class="left">
                    <b>BE No</b>
                </td>

                <td class="left">
                    {{ $data->be_no ? 'C-' . $data->be_no : '' }}
                </td>
            </tr>

            <tr>
                <td class="left">
                    <b>BE Date</b>
                </td>

                <td class="left">
                    {{ $data->be_date }}
                </td>

                <td class="left">
                    <b>Lane</b>
                </td>

                <td class="left">
                    {{ $data->be_lane }}
                </td>
            </tr>
        </table>
    </div>



    <!-- ITEMS -->
    <div class="box">
        <div class="box-title">
            Items & Container Details
        </div>
        @php

            $items = collect($data->items ?? [])
                ->filter(fn($i) => !empty($i['goods_name']))
                ->values();

            $containers = collect($data->containers ?? [])
                ->filter(fn($c) => !empty($c['container_no']))
                ->values();

            $rowCount = max($items->count(), $containers->count(), 1);

            $total_net_weight = collect($data->items ?? [])->sum(fn($item) => (float) ($item['net_weight'] ?? 0));

        @endphp
        <table>
            <thead>
                <tr>
                    <th>Goods Name</th>
                    <th>Qty</th>
                    <th>Value</th>
                    <th>N.W</th>
                    <th>G.W</th>
                    <th>Container</th>
                    <th>Yard</th>
                </tr>
            </thead>

            <tbody>
                @for ($i = 0; $i < $rowCount; $i++)
                    <tr>
                        <td>
                            {{ $items[$i]['goods_name'] ?? '' }}
                        </td>

                        <td>
                            @if (isset($items[$i]))
                                {{ $items[$i]['item_quantity'] ?? '' }}

                                {{ $data->pkgs_code }}
                            @endif
                        </td>

                        <td>
                            @if (isset($items[$i]))
                                $ {{ number_format((float) ($items[$i]['item_value'] ?? 0), 2) }}
                            @endif
                        </td>

                        <td>
                            @if (isset($items[$i]))
                                {{ number_format((float) ($items[$i]['net_weight'] ?? 0), 2) }}

                                KGS
                            @endif
                        </td>

                        <td>
                            @if (isset($items[$i]))
                                {{ number_format((float) ($items[$i]['item_gross_weight'] ?? 0), 2) }}

                                KGS
                            @endif
                        </td>

                        <td>
                            {{ $containers[$i]['container_no'] ?? '' }}

                            @if (isset($containers[$i]))
                                X {{ $containers[$i]['container_size'] }}
                            @endif
                        </td>

                        <td>
                            @if (isset($containers[$i]))
                                Y- {{ $containers[$i]['container_location'] }}
                            @endif
                        </td>
                    </tr>
                @endfor
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>
                        {{ $data->total_quantity }}
                        {{ $data->pkgs_code }}
                    </th>

                    <th>
                        $
                        {{ number_format($data->invoice_value ?? 0, 2) }}
                    </th>

                    <th>
                        {{ number_format($total_net_weight, 2) }}
                        KGS
                    </th>

                    <th>
                        {{ number_format($data->gross_weight ?? 0, 2) }}

                        KGS
                    </th>

                    <th></th>

                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

</body>

</html>
