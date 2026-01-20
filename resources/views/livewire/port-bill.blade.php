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

            <div class="col-md-6">

                <div class="full counter_section margin_bottom_30">
                    <form wire:submit.prevent="createEnty" id="new_enty_form">
                        <div class="row">
                            <div class="col-md-3 ">
                                <label for="importer_name">Importer Name</label>
                                <input type="text" wire:model="importer_name" name="importer_name"
                                    class="form-control text-uppercase">
                                @error('importer_name')
                                    <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="goods_name">Goods Name</label>
                                <input type="text" wire:model="goods_name" name="goods_name"
                                    class="form-control text-uppercase">
                                @error('goods_name')
                                    <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="quantity">Quantity</label>
                                <input type="text" wire:model="quantity" name="quantity" class="form-control">
                                @error('quantity')
                                    <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="pkgs_code">Pkgs Code</label>
                                <select wire:model="pkgs_code" class="form-control">
                                    <option hidden></option>
                                    <option value="ROLLS">ROLLS </option>
                                    <option value="PKGS">PKGS </option>
                                    <option value="BALES">BALES </option>
                                    <option value="CTNS">CTNS </option>
                                    <option value="BAGS">BAGS </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="vessel">Vessel</label>
                                <input type="text" wire:model="vessel" name="vessel"
                                    class="form-control text-uppercase">
                            </div>
                            <div class="col-md-3">
                                <label for="bl_no">BL No</label>
                                <input type="text" wire:model="bl_no" name="bl_no"
                                    class="form-control text-uppercase">
                                @error('bl_no')
                                    <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="container_no">Container No</label>
                                <input type="text" wire:model="container_no"
                                    name="container_no"class="form-control text-uppercase">
                                @error('container_no')
                                    <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="container_size">Container Size</label>
                                <select wire:model="container_size" class="form-control">
                                    <option hidden></option>
                                    <option value="20' FCL">20' FCL </option>
                                    <option value="40' FCL">40' FCL </option>
                                    <option value="20' LCL">20' LCL </option>
                                    <option value="40' LCL">40' LCL </option>
                                    <option value="BULK">BULK </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for=" lc_number">Lc Number</label>
                                <input type="text" wire:model="lc_number" name="lc_number" class="form-control">
                                @error('lc_number')
                                    <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="lc_date">LC Date</label>
                                <input type="date" wire:model="lc_date" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label for="gross_weight">Gross Weight</label>
                                <input type="text" wire:model="gross_weight" name="gross_weight"
                                    class="form-control">
                            </div>

                            <div class="col-md-3 ">
                                <label for="arivel_date">Arivel Date</label>
                                <input type="date" wire:model="arivel_date" class="form-control">
                            </div>

                            <div class="col-md-6 my-3">
                                <button type="submit" class="main_bt">Create</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-md-6">

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
