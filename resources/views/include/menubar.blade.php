<div class="sticky">
    <div class="horizontal-main hor-menu clearfix">
        <div class="horizontal-mainwrapper container clearfix">
            <!--Nav-->
            <nav class="horizontalMenu clearfix">
                <ul class="horizontalMenu-list">
                    <li aria-haspopup="true"><a href="{{URL::to('/dashboard')}}"><i class="fe fe-home"></i> Dashboard</a></li>
                    @hasanyrole('admin-master|admin')
                        @include('include.component.navbar-admin-m')
                    @endhasanyrole

                    @hasanyrole('admin-kepolisian')
                        @include('include.component.navbar-admin-kepolisian')
                    @endhasanyrole

                    @hasanyrole('admin-kejaksaan')
                        @include('include.component.navbar-admin-kejaksaan')
                    @endhasanyrole

                    @hasanyrole('kepolisian')
                        @include('include.component.navbar-kepolisian')
                    @endhasanyrole

                    @hasanyrole('kejaksaan')
                        @include('include.component.navbar-kejaksaan')
                    @endhasanyrole

                    @hasanyrole('pengadilan')
                        @include('include.component.navbar-pengadilan')
                    @endhasanyrole

                    @hasanyrole('admin-lapas|lapas')
                        @include('include.component.navbar-lapas')
                    @endhasanyrole
                    
                    @hasanyrole('operator-01|operator-02|operator-03|operator-04|operator-kasi-pidum|operator-kasi-pidsus')
                        @include('include.component.navbar-operator')
                    @endhasanyrole
                </ul>
            </nav>
            <!--Nav-->
        </div>
    </div>
</div>