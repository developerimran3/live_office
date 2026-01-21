<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>New Enty By Copy BL</h2>
                </div>
            </div>
        </div>








        <div class="row column1">

            <div class="col-md-5">
                <div class="full counter_section margin_bottom_30">

                    <form wire:submit.prevent="createEnty">

                        <!-- ARRIVAL + 40FT -->
                        <div class="form-row align-items-center mb-2">
                            <div class="col-3 label-cell">ARRIVAL DT</div>
                            <div class="col-3">
                                <input type="date" class="form-control"
                                    wire:model="arrival
                                
                                _dt">
                            </div>

                            <div class="col-3 label-cell text-center">CONT(s)</div>
                            <div class="col-3">
                                <input type="number" class="form-control" wire:model="cont_40">
                            </div>

                        </div>

                        <!-- C/L + 20FT -->
                        <div class="form-row align-items-center mb-2">
                            <div class="col-3 label-cell">C/L DT</div>
                            <div class="col-3">
                                <input type="date" class="form-control" wire:model="cl_dt">
                            </div>

                            <div class="col-1"></div>
                            <div class="col-1">
                                <input type="number" class="form-control" wire:model="cont_20">
                            </div>
                            <div class="col-1 text-center">×20×8.5</div>

                            <div class="col-1 highlight text-right">TOTAL</div>
                            <div class="col-2">
                                <input type="text" class="form-control" wire:model="total_20" readonly>
                            </div>
                        </div>

                        <!-- W/R + RATE + ADO -->
                        <div class="form-row align-items-center mb-2">
                            <div class="col-3 label-cell">W/R DT</div>
                            <div class="col-3">
                                <input type="date" class="form-control" wire:model="wr_dt">
                            </div>

                            <div class="col-2 label-cell">RATE ($)</div>
                            <div class="col-2">
                                <input type="number" step="0.01" class="form-control" wire:model="rate">
                            </div>

                            <div class="col-2 label-cell">ADO DT</div>
                            <div class="col-2">
                                <input type="date" class="form-control" wire:model="ado_dt">
                            </div>
                        </div>

                        <!-- W/R UPTO + DAYS + DG -->
                        <div class="form-row align-items-center mb-2">
                            <div class="col-3 label-cell">W/R UP/TO DT</div>
                            <div class="col-3">
                                <input type="date" class="form-control" wire:model="wr_upto_dt">
                            </div>

                            <div class="col-2 label-cell">DAY(s)</div>
                            <div class="col-2">
                                <input type="number" class="form-control" wire:model="days">
                            </div>

                            <div class="col-2 orange">DG Status</div>
                            <div class="col-2">
                                <input type="text" class="form-control" wire:model="dg_status">
                            </div>
                        </div>

                        <!-- EXTRA MOVEMENT -->
                        <div class="form-row align-items-center mb-2">
                            <div class="col-4 label-cell">EXTRA MOVEMENT</div>
                            <div class="col-2">
                                <input type="number" class="form-control" wire:model="extra_movement">
                            </div>
                            <div class="col-6">CONT(s)</div>
                        </div>

                        <!-- HOSTING -->
                        <div class="form-row align-items-center mb-2">
                            <div class="col-4 label-cell">HOSTING CHARGE</div>
                            <div class="col-2">
                                <input type="number" class="form-control" wire:model="hosting_charge">
                            </div>
                            <div class="col-6">TON</div>
                        </div>

                        <!-- RPC -->
                        <div class="form-row align-items-center mb-3">
                            <div class="col-4 label-cell">RPC</div>
                            <div class="col-2">
                                <input type="number" class="form-control" wire:model="rpc">
                            </div>
                            <div class="col-6">PCS</div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-sm">
                                Save Entry
                            </button>
                        </div>


                    </form>

                </div>
            </div>


            <div class="col-md-7">
                <div class="full counter_section margin_bottom_30">
                    <div class=" full">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
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
                                        <td>STORE RENT (2N) NR</td>
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
                                        <td>STORE RENT (2N) NR</td>
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
                            </table>
                        </div>

                    </div>
                </div>
            </div>


        </div>
