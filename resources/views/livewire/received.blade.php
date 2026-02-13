 <!-- end topbar -->
 <div class="midde_cont">
     <div class="container-fluid">
         <div class="row column_title">
             <div class="col-md-12">
                 <div class="page_title">
                     <h2>Orginial Documents Received</h2>
                 </div>
             </div>
         </div>
         {{-- @if ($receivedId)
             <div class="row column1">
                 <div class="col-md-12">
                     <div class="white_shd full p-4">
                         <div class="heading1 margin_0">
                             <h2>Documents Details</h2>
                             <hr class="m-0">
                         </div>
                         <form wire:submit.prevent="updateReceived({{ $receivedId }})">
                             <div class="row">
                                 <div class="col-md-3">
                                     <label for="bl_no">BL No</label>
                                     <input type="text" wire:model="bl_no" class="form-control" readonly>
                                 </div>
                                 @if (!$vessel)
                                     <div class="col-md-3">
                                         <label for="vessel">Vessel</label>
                                         <input type="text" wire:model="vessel" name="vessel"
                                             class="form-control text-uppercase">
                                     </div>
                                 @endif
                                 <div class="col-md-3">
                                     <label for="vessel">Rotation No</label>
                                     <input type="text" wire:model="rot_no" name="rot_no" class="form-control">
                                     @error('rot_no')
                                         <p class="text-danger"> {{ $message }}</p>
                                     @enderror
                                 </div>

                                 @foreach ($container_locations as $i => $loc)
                                     <div class="col-md-3">
                                         <label>Container Location</label>
                                         <input type="text" wire:model="container_locations.{{ $i }}"
                                             class="form-control">
                                     </div>
                                 @endforeach


                                 <div class="col-md-3">
                                     <label for="invoice_value">Invoice Value</label>
                                     <input type="text" wire:model="invoice_value" name="invoice_value"
                                         class="form-control" placeholder="Invoice Value">
                                     @error('invoice_value')
                                         <p class="text-danger"> {{ $message }}</p>
                                     @enderror
                                 </div>
                                 <div class="col-md-3">
                                     <label for="invoice_no">Invoice Number</label>
                                     <input type="text" wire:model="invoice_no" name="invoice_no"
                                         class="form-control text-uppercase" placeholder="Invoice Number">
                                     @error('invoice_no')
                                         <p class="text-danger"> {{ $message }}</p>
                                     @enderror
                                 </div>
                                 <div class="col-md-3">
                                     <label for="invoice_date">Invoice Date</label>
                                     <input type="date" wire:model="invoice_date" name="invoice_date"
                                         class="form-control" placeholder="Invoice Date">
                                     @error('invoice_date')
                                         <p class="text-danger"> {{ $message }}</p>
                                     @enderror
                                 </div>

                                 <div class="col-md-3">
                                     @foreach ($net_weights as $i => $w)
                                         <label>Net Weight</label>
                                         <input type="number" wire:model="net_weights.{{ $i }}"
                                             class="form-control">
                                     @endforeach
                                     @error('net_weight')
                                         <p class="text-danger"> {{ $message }}</p>
                                     @enderror
                                 </div>

                                 <div class="col-md-6 my-3">
                                     <button type="submit" class="main_bt">Update</button>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         @endif --}}

         @if ($receivedId)
             <div class="card p-3 mb-3">
                 <h4>Edit Received Document</h4>

                 <form wire:submit.prevent="updateReceived">
                     <div class="row mb-2">
                         <div class="col-md-3">
                             <label>BL No</label>
                             <input type="text" wire:model="bl_no" class="form-control" readonly>
                         </div>
                         <div class="col-md-3">
                             <label>Vessel</label>
                             <input type="text" wire:model="vessel" class="form-control">
                         </div>
                         <div class="col-md-3">
                             <label>Rotation No</label>
                             <input type="text" wire:model="rot_no" class="form-control">
                         </div>
                         <div class="col-md-3">
                             <label>Invoice Value</label>
                             <input type="text" wire:model="invoice_value" class="form-control">
                         </div>
                         <div class="col-md-3">
                             <label>Invoice No</label>
                             <input type="text" wire:model="invoice_no" class="form-control">
                         </div>
                         <div class="col-md-3">
                             <label>Invoice Date</label>
                             <input type="date" wire:model="invoice_date" class="form-control">
                         </div>
                     </div>

                     @foreach ($items as $i => $item)
                         <div class="card p-2 mb-2 border">
                             <h5>
                                 Item Name: <input type="text" wire:model="items.{{ $i }}.goods_name"
                                     class="form-control">
                             </h5>
                             <div>Quantity: <input type="number" wire:model="items.{{ $i }}.quantity"
                                     class="form-control mb-2"></div>

                             <h6>Containers</h6>
                             @foreach ($item['containers'] as $j => $c)
                                 <div class="d-flex mb-1">
                                     <input type="text"
                                         wire:model="items.{{ $i }}.containers.{{ $j }}.container_no"
                                         class="form-control me-1" placeholder="Container No">
                                     <input type="text"
                                         wire:model="items.{{ $i }}.containers.{{ $j }}.container_location"
                                         class="form-control me-1" placeholder="Location">
                                     <input type="number"
                                         wire:model="items.{{ $i }}.containers.{{ $j }}.net_weight"
                                         class="form-control me-1" placeholder="Net Weight">
                                     <button type="button"
                                         wire:click="removeContainer({{ $i }}, {{ $j }})"
                                         class="btn btn-danger btn-sm">−</button>
                                 </div>
                             @endforeach
                             <button type="button" wire:click="addContainer({{ $i }})"
                                 class="btn btn-success btn-sm mt-1">+ Container</button>
                             <button type="button" wire:click="removeItem({{ $i }})"
                                 class="btn btn-danger btn-sm mt-1">Remove Item</button>
                         </div>
                     @endforeach

                     <button type="button" wire:click="addItem" class="btn btn-primary mt-2">+ Add Item</button>
                     <button type="submit" class="btn btn-success mt-2">Update</button>
                 </form>
             </div>
         @endif

         <!-- table srart -->
         <div class="row column1 pt-lg-4">
             <div class="col-md-12">
                 <div class="white_shd full p-4">
                     <div>
                         @if (Session::has('success'))
                             <div class="alert alert-success alert-dismissible fade show" role="alert">
                                 {{ Session::get('success') }}
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                         @endif
                         @error('invoice_no')
                             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                 {{ $message }}
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                         @enderror
                     </div>
                     <div class="heading1 m-0 p-0">
                         <h2 class="">All Received Documents</h2>
                     </div>
                     <div class="row column1">
                         <div class="col-md-12">
                             <div class=" full">
                                 <div class="heading1 margin_0">
                                     <table class="table table-bordered table-striped mb-none dataTable no-footer "
                                         id="dataTable">
                                         <thead>
                                             <tr class="document_received">
                                                 <th>#</th>
                                                 <th>Importer Name</th>
                                                 <th>Goods Name</th>
                                                 <th>Quantity</th>
                                                 <th>Vessel</th>
                                                 <th>BL. No</th>
                                                 <th>Rot. No</th>
                                                 <th>Cont. No</th>
                                                 <th>Yard</th>
                                                 <th>Value</th>
                                                 <th>Invoice No</th>
                                                 <th>IV. Date</th>
                                                 <th>N.W</th>
                                                 <th>Rec. Doc</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             @foreach ($receiveds as $r)
                                                 <tr class="document_received">
                                                     <td> {{ $loop->iteration }} </td>
                                                     <td>{{ $r->importer_name }}</td>
                                                     <td class="text-uppercase">
                                                         @foreach ($r->items ?? [] as $item)
                                                             {{ $item['goods_name'] }} <br>
                                                         @endforeach

                                                     </td>
                                                     <td>
                                                         @foreach ($r->items ?? [] as $item)
                                                             {{ $item['quantity'] }} {{ $r->pkgs_code }} <br>
                                                         @endforeach
                                                     </td>
                                                     <td>{{ $r->vessel }}</td>
                                                     <td>{{ $r->bl_no }}</td>
                                                     <td>{{ $r->rot_no }} </td>
                                                     <td>
                                                         @foreach ($r->containers ?? [] as $c)
                                                             {{ $c['container_no'] }} x {{ $c['container_size'] }}
                                                             <br>
                                                         @endforeach
                                                     </td>

                                                     <td>
                                                         @foreach ($r->container_locations ?? [] as $loc)
                                                             Y-{{ $loc }} <br>
                                                         @endforeach
                                                     </td>
                                                     <td>$ {{ number_format($r->invoice_value ?? 0, 2) }}</td>
                                                     <td>{{ $r->invoice_no }}</td>
                                                     <td>{{ $r->invoice_date }}</td>

                                                     <td>
                                                         @foreach ($r->net_weights ?? [] as $w)
                                                             {{ $w }} KGS <br>
                                                         @endforeach
                                                     </td>
                                                     <td>{{ $r->document_receiver }}</td>
                                                     <td>
                                                         <a class="btn btn-sm btn-warning"
                                                             wire:click="editToReceived({{ $r->id }})">
                                                             <i class="fa fa-edit"></i></a>
                                                         @if ($r->invoice_value && $r->invoice_no && $r->invoice_date && $r->net_weights && $r->rot_no && $r->vessel)
                                                             <a class="btn btn-sm btn-success"
                                                                 wire:click="moveToRegister({{ $r->id }})"
                                                                 wire:confirm="Are you Move To Register Document?">
                                                                 <i class="fa fa-arrow-circle-right "></i></a>
                                                         @endif
                                                     </td>
                                                 </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- table end -->
