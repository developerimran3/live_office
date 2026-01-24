<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>New Enty By Copy BL</h2>
                </div>
            </div>
        </div>

        <a href="{{ url('/port-rate') }}" wire:navigate class="btn btn-sm btn-warning">RATE UPDATE</a>

        <div class="row column1">
            <div class="col-md-5">
                <div class="full margin_bottom_30 bg-white p-4">

                    <form wire:submit.prevent="createEnty">
                        <!-- C/L DT + CONTAINER -->
                        <div class="form-row align-items-center mb-2">
                            <div class="col-2 label-cell">C/L DT</div>
                            <div class="col-3">
                                <input type="date" class="form-control" wire:model.lazy="cl_date">
                            </div>

                            <div class="col-2"></div>

                            <div class="col-2 label-cell">CONT(s)</div>
                            <div class="col-3">
                                <select name="cont_select" class="form-control">
                                    <option>--select--</option>
                                    <option value="20fcl">20' FCL</option>
                                    <option value="40fcl">40' FCL</option>
                                    <option value="lockfast">LOCKFAST</option>
                                    <option value="warehouse">WAREHOUSE</option>
                                </select>
                            </div>
                        </div>

                        <!-- UNSTF + QNTY -->
                        <div class="form-row align-items-center mb-2">
                            <div class="col-2 label-cell">UNSTF DT</div>
                            <div class="col-3">
                                <input type="date" class="form-control" wire:model.lazy="unstf_date">
                            </div>

                            <div class="col-2"></div>

                            <div class="col-2 label-cell">QNTY</div>
                            <div class="col-3">
                                <input type="number" class="form-control" wire:model.debounce.500ms="qty"
                                    placeholder="1">
                            </div>
                        </div>

                        <!-- W/R DT + RATE -->
                        <div class="form-row align-items-center mb-2">
                            <div class="col-2 label-cell">W/R DT</div>
                            <div class="col-3">
                                <input type="date" class="form-control" wire:model="wr_date" readonly>
                            </div>

                            <div class="col-2"></div>

                            <div class="col-2 label-cell">EXCH RATE</div>
                            <div class="col-3">
                                <input type="text" class="form-control" wire:model.debounce.500ms="usd_rate"
                                    placeholder="122.70">
                            </div>
                        </div>

                        <!-- UP TO + DAYS -->
                        <div class="form-row align-items-center mb-2">
                            <div class="col-2 label-cell">UP TO DT</div>
                            <div class="col-3">
                                <input type="date" class="form-control" wire:model.lazy="upto_date">
                            </div>

                            <div class="col-2"></div>

                            <div class="col-2 label-cell">DAY(s)</div>
                            <div class="col-3">
                                <input type="text" class="form-control" wire:model="days" readonly>
                            </div>
                        </div>

                        <!-- ADO + DG -->
                        <div class="form-row align-items-center mb-3">
                            <div class="col-2 label-cell">ADO DT</div>
                            <div class="col-3">
                                <input type="date" class="form-control" wire:model="ado_dt" readonly>
                            </div>

                            <div class="col-2"></div>

                            <div class="col-2 text-warning font-weight-bold">DG</div>
                            <div class="col-3">
                                <select name="dg_status" class="form-control">
                                    <option>--select--</option>
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <!-- EXTRA MOVEMENT -->
                        <div class="form-row align-items-center mb-3">
                            <div class="col-2 label-cell">EXT. MOV</div>
                            <div class="col-2">
                                <input type="number" class="form-control" wire:model.debounce.500ms="extra_mov"
                                    placeholder="0">
                            </div>

                            <div class="col-2 label-cell">RPC</div>
                            <div class="col-2">
                                <input type="number" class="form-control" wire:model.debounce.500ms="rpc"
                                    placeholder="0">
                            </div>

                            <div class="col-2 label-cell">HC</div>
                            <div class="col-2">
                                <input type="number" class="form-control" wire:model.debounce.500ms="hc"
                                    placeholder="0">
                            </div>
                        </div>

                        <!-- SUBMIT -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-success btn-sm">
                                Save Entry
                            </button>
                        </div>

                    </form>
                </div>
            </div>



            <div class="col-md-7">
                <div class="full counter_section margin_bottom_30">

                    <div class="table-responsive">

                        @if (!empty($calculated))
                            <table class="table table-bordered table-sm mt-3">
                                <thead class="port_bill">
                                    <tr>
                                        <th>DESCRIPTION</th>
                                        <th>RATE (T/$)</th>
                                        <th>QNTY</th>
                                        <th>DAYS</th>
                                        <th>PORT (TK)</th>
                                        <th>VAT (TK)</th>
                                        <th>MLWF (TK)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>RIVER DUES CNT</td>
                                        <td class="text-right">{{ number_format($calculated['river_dues'], 2) }}</td>
                                        <td class="text-center">{{ $qnty }}</td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">{{ number_format($calculated['river_dues'], 2) }}</td>
                                        <td class="text-right">{{ number_format($calculated['vat'], 2) }}</td>
                                        <td class="text-right">{{ number_format($calculated['mlwf'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>LIFT ON</td>
                                        <td class="text-right">{{ number_format($calculated['lift_on'], 2) }}</td>
                                        <td class="text-center">{{ $qnty }}</td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">{{ number_format($calculated['lift_on'], 2) }}</td>
                                        <td class="text-right">{{ number_format($calculated['vat'], 2) }}</td>
                                        <td class="text-right">{{ number_format($calculated['mlwf'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>RPC</td>
                                        <td class="text-right">{{ number_format($calculated['rpc'], 2) }}</td>
                                        <td class="text-center">{{ $qnty }}</td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">{{ number_format($calculated['rpc'], 2) }}</td>
                                        <td class="text-right">{{ number_format($calculated['vat'], 2) }}</td>
                                        <td class="text-right">{{ number_format($calculated['mlwf'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>STORE RENT</td>
                                        <td class="text-right">{{ number_format($calculated['store_rent'], 2) }}</td>
                                        <td class="text-center">{{ $qnty }}</td>
                                        <td class="text-center">{{ $days }}</td>
                                        <td class="text-right">{{ number_format($calculated['store_rent'], 2) }}</td>
                                        <td class="text-right">{{ number_format($calculated['vat'], 2) }}</td>
                                        <td class="text-right">{{ number_format($calculated['mlwf'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>EXTRA MOVEMENT + HC</td>
                                        <td class="text-right">
                                            {{ number_format($calculated['extra_mov'] + $calculated['hc'], 2) }}</td>
                                        <td class="text-center">{{ $qnty }}</td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">
                                            {{ number_format($calculated['extra_mov'] + $calculated['hc'], 2) }}</td>
                                        <td class="text-right">{{ number_format($calculated['vat'], 2) }}</td>
                                        <td class="text-right">{{ number_format($calculated['mlwf'], 2) }}</td>
                                    </tr>

                                    <tr class="total-row font-weight-bold">
                                        <td colspan="3" class="text-right">TOTAL</td>
                                        <td class="text-center">{{ $days }}</td>
                                        <td class="text-right">{{ number_format($calculated['total_port'], 2) }}</td>
                                        <td class="text-right">{{ number_format($calculated['vat'], 2) }}</td>
                                        <td class="text-right">{{ number_format($calculated['mlwf'], 2) }}</td>
                                    </tr>

                                    <tr class="gross-row bg-info text-white font-weight-bold">
                                        <td colspan="6" class="text-right">GROSS</td>
                                        <td class="text-right">
                                            {{ number_format($calculated['total_port'] + $calculated['vat'] + $calculated['mlwf'], 2) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                        {{-- <table class="table table-bordered table-sm">
                            <thead class="port_bill">
                                <tr>
                                    <th>DESCRIPTION</th>
                                    <th>RATE (T/$)</th>
                                    <th>QNTY</th>
                                    <th>DAYS</th>
                                    <th>PORT (TK)</th>
                                    <th>VAT (TK)</th>
                                    <th>MLWF (TK)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>RIVER DUES CNT (2N)</td>
                                    <td class="text-right">10.82</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">-</td>
                                    <td class="text-right">1,327.61</td>
                                    <td class="text-right">199.14</td>
                                    <td class="text-right">53.11</td>
                                </tr>
                                <tr>
                                    <td>LIFT ON (2N)</td>
                                    <td class="text-right">30.00</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">-</td>
                                    <td class="text-right">3,681.00</td>
                                    <td class="text-right">552.15</td>
                                    <td class="text-right">-</td>
                                </tr>
                                <tr>
                                    <td>REPAIRING CHARGE (2N)</td>
                                    <td class="text-right">7.50</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">-</td>
                                    <td class="text-right">7.50</td>
                                    <td class="text-right">1.13</td>
                                    <td class="text-right">-</td>
                                </tr>
                                <tr>
                                    <td>STORE RENT (1N) NR</td>
                                    <td class="text-right">13.80</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">7</td>
                                    <td class="text-right">11,852.82</td>
                                    <td class="text-right">1,777.92</td>
                                    <td class="text-right">-</td>
                                </tr>
                                <tr>
                                    <td>STORE RENT (2N) NR</td>
                                    <td class="text-right">27.60</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">13</td>
                                    <td class="text-right">44,024.76</td>
                                    <td class="text-right">6,603.71</td>
                                    <td class="text-right">-</td>
                                </tr>
                                <tr>
                                    <td>STORE RENT (3N) NR</td>
                                    <td class="text-right">55.20</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">23</td>
                                    <td class="text-right">155,779.92</td>
                                    <td class="text-right">23,366.99</td>
                                    <td class="text-right">-</td>
                                </tr>
                                <tr>
                                    <td>EXTRA MOVEMENT (2N)</td>
                                    <td class="text-right">68.90</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                </tr>
                                <tr>
                                    <td>HOSTING CHARGES (2N)</td>
                                    <td class="text-right">5.42</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                </tr>

                                <tr class="total-row font-weight-bold">
                                    <td colspan="3" class="text-right">TOTAL</td>
                                    <td class="text-center">43</td>
                                    <td class="text-right">216,673.61</td>
                                    <td class="text-right">32,501.04</td>
                                    <td class="text-right">53.11</td>
                                </tr>

                                <tr class="gross-row bg-info text-white font-weight-bold">
                                    <td colspan="6" class="text-right">GROSS</td>
                                    <td class="text-right">249,227.76</td>
                                </tr>
                            </tbody>
                        </table> --}}
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Port Rate Set -->


</div>
