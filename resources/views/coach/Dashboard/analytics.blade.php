@extends('layouts.app-blog-create')
@section('styles')
    <link href="{{asset('assets/src/plugins/src/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/dark/widgets/modules-widgets.css')}}">
    <link href="{{asset('assets/src/assets/css/dark/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/src/assets/css/light/widgets/modules-widgets.css')}}">
    <link href="{{asset('assets/src/assets/css/light/components/list-group.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('assets/src/assets/css/light/scrollspyNav.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/src/plugins/css/light/apex/custom-apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/src/assets/css/dark/scrollspyNav.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/src/plugins/css/dark/apex/custom-apexcharts.css')}}" rel="stylesheet" type="text/css">

@endsection
@section('content')
    <div class="row my-2">
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-user text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Users</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="users-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-dumbbell text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Coaches</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="coaches-body"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-box-open text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Products</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="products-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-tag text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Brands</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="brands-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-square text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Categories</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="categories-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-graduation-cap text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>muscles</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="muscles-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-bell text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Subscriptions</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="subscriptions-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-dollar-sign text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Purchases Count</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="purchases-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


        <div class="col-12 layout-spacing">
            <div class="widget widget-table-one">
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="icon">
                                        <i class="fa-light fa-dollar-sign text-warning"></i>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Total Sales</h4>
                                    <p class="meta-date time-field" id="timeField"></p>
                                </div>

                            </div>
                            <div class="t-rate rate-dec">
                                <p><span id="sales-body"></span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center " id="cancel-row">
        <div id="chartArea" class="col-xl-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div id="s-line-area" class=""></div>
                </div>
            </div>
        </div>
        <div id="chartArea" class="col-xl-6 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div id="s-line-area-coaches" class=""></div>
                </div>
            </div>
        </div>
        <div id="chartArea" class="col-xl-6 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div id="s-line-area-products" class=""></div>
                </div>
            </div>
        </div>
        <div id="chartArea" class="col-xl-6 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div id="s-line-area-brands" class=""></div>
                </div>
            </div>
        </div>
        <div id="chartArea" class="col-xl-6 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div id="s-line-area-categories" class=""></div>
                </div>
            </div>
        </div>
        <div id="chartArea" class="col-xl-6 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div id="s-line-area-muscles" class=""></div>
                </div>
            </div>
        </div>
    </div>

    <div class=" col-12 layout-spacing">
        <div class="widget widget-table-three">

            <div class="widget-heading">
                <h5 class="">Recent muscles Clients </h5>
                <label for="RecentmusclesClientsSelect">Items</label>
                <select class="form-control col-md-4" id="RecentmusclesClientsSelect">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-scroll" id="recentmusclesClientsTable">
                        <thead>
                        <tr>
                            <th>
                                <div class="th-content">Name</div>
                            </th>

                            <th>
                                <div class="th-content th-heading">Phone Number</div>
                            </th>
                            <th>
                                <div class="th-content">Country</div>
                            </th>
                            <th>
                                <div class="th-content">Age</div>
                            </th>
                            <th>
                                <div class="th-content">muscle</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="recentmusclesClientsTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class=" col-12 layout-spacing">
        <div class="widget widget-table-three">

            <div class="widget-heading">
                <h5 class="">Recent Products Clients </h5>
                <label for="RecentProductsClientsSelect">Items</label>
                <select class="form-control col-md-4" id="RecentProductsClientsSelect">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-scroll" id="recentProductsClientsTable">
                        <thead>
                        <tr>
                            <th>
                                <div class="th-content">Name</div>
                            </th>

                            <th>
                                <div class="th-content th-heading">Phone Number</div>
                            </th>
                            <th>
                                <div class="th-content">Country</div>
                            </th>
                            <th>
                                <div class="th-content">Age</div>
                            </th>
                            <th>
                                <div class="th-content">Product</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="recentProductsClientsTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('assets/src/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/apex/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/apex/custom-apexcharts.js')}}"></script>
    <script>

        try {
            getDashBoard()



            let RecentmusclesClientsSelect=document.getElementById('RecentmusclesClientsSelect')
            let selectedOptionmuscles = RecentmusclesClientsSelect.options[RecentmusclesClientsSelect.selectedIndex];

            getRecentmusclesClients(selectedOptionmuscles.value)
            RecentmusclesClientsSelect.addEventListener('change', (e) => {
                //selectedType.options[selectedType.selectedIndex].text
                getRecentmusclesClients(e.target.value)

                });
            let RecentProductsClientsSelect=document.getElementById('RecentProductsClientsSelect')
            let selectedOptionProducts= RecentProductsClientsSelect.options[RecentProductsClientsSelect.selectedIndex];
            getRecentProductsClients(selectedOptionProducts.value)
            RecentProductsClientsSelect.addEventListener('change', (e) => {
                //selectedType.options[selectedType.selectedIndex].text
                getRecentProductsClients(e.target.value)

                });
        } catch (error) {

        }

        async function getDashBoard() {
            let response = await fetch('/api/statistics', {
                method: 'GET'
            })
            let result = await response.json();

            console.log(result)
            let time = new Date(result.data.time);
            $('.time-field').append(time.getHours() + ':' + time.getMinutes() + ':' + time.getSeconds())
            $('#users-body').html(result.data.users)
            $('#coaches-body').html(result.data.coaches)
            $('#products-body').html(result.data.products)
            $('#brands-body').html(result.data.brands)
            $('#categories-body').html(result.data.categories)
            $('#muscles-body').html(result.data.muscles)
            $('#subscriptions-body').html(result.data.subscriptions)
            $('#purchases-body').html(result.data.purchases)
            $('#sales-body').html(Math.round( result.data.sales,3) + ' $')
        }



        async function getRecentmusclesClients(limit) {
            const recentmusclesClientsTable = document.getElementById('recentmusclesClientsTable');
            var rowCount = recentmusclesClientsTable.rows.length;
            for (var i = rowCount - 1; i > 0; i--) { // loop through rows starting from bottom
                recentmusclesClientsTable.deleteRow(i); // delete each row
            }

            let response = await fetch(`/api/recent-muscles-clients/${limit}`, {
                method: 'GET'
            })
            let result = await response.json();

            console.log(result)
            result.data.recentClients.forEach(item => {
                const newRow = recentmusclesClientsTable.insertRow(); // create a new row

                // add cells to the row to display the data
                const nameCell = newRow.insertCell();
                nameCell.innerHTML = `
                                        <div class="td-content product-name">
                                            <img src="/${item.user.profile_image}" alt="client">
                                            <div class="align-self-center">
                                                <a href="/coach/users/${item.user.id}">
                                                    <p class="prd-name">${item.user.name}</p>
                                                    <p class="prd-category text-primary">${item.user.email}</p>
                                                </a>
                                            </div>
                                        </div>`;

                const phoneCell = newRow.insertCell();
                phoneCell.innerHTML = item.user.phone_number;

                const countryCell = newRow.insertCell();
                countryCell.innerHTML = item.user.country;

                const ageCell = newRow.insertCell();
                ageCell.innerHTML = item.user.age;

                const muscleCell = newRow.insertCell();
                muscleCell.innerHTML = `
                <a href="/coach/muscles/${item.muscle.id}">
                    ${item.muscle.title}
                </a>`;
            });
        }


        async function getRecentProductsClients(limit) {
            const recentProductsClientsTable = document.getElementById('recentProductsClientsTable');
            var rowCount = recentProductsClientsTable.rows.length;
            for (var i = rowCount - 1; i > 0; i--) { // loop through rows starting from bottom
                recentProductsClientsTable.deleteRow(i); // delete each row
            }



            let response = await fetch(`/api/recent-products-clients/${limit}`, {
                method: 'GET',
            })
            let result = await response.json();

            result.data.recentClients.forEach(item => {
                const newRow = recentProductsClientsTable.insertRow(); // create a new row

                // add cells to the row to display the data
                const nameCell = newRow.insertCell();
                nameCell.innerHTML = `
                                        <div class="td-content product-name">
                                            <img src="/${item.user.profile_image}" alt="client">
                                            <div class="align-self-center">
                                                <a href="/coach/users/${item.user.id}">
                                                    <p class="prd-name">${item.user.name}</p>
                                                    <p class="prd-category text-primary">${item.user.email}</p>
                                                </a>
                                            </div>
                                        </div>`;

                const phoneCell = newRow.insertCell();
                phoneCell.innerHTML = item.user.phone_number;

                const countryCell = newRow.insertCell();
                countryCell.innerHTML = item.user.country;

                const ageCell = newRow.insertCell();
                ageCell.innerHTML = item.user.age;

                const muscleCell = newRow.insertCell();
                muscleCell.innerHTML = `
                <a href="/coach/products/${item.product.id}">
                    ${item.product.name}
                      <p class="prd-category">Quantity:${item.quantity}</p>
                </a>`;
            });
        }
    </script>
@endsection



