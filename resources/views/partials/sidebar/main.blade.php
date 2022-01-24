<nav class="col-md-2 sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column pb-4">
            @foreach (\Vanguard\Plugins\Vanguard::availablePlugins() as $plugin)
                @include('partials.sidebar.items', ['item' => $plugin->sidebar()])

            @endforeach
                @permission('settings.all')
                    <li class="nav-item">
                        
                        <a class="nav-link" href="#setting" data-toggle="collapse" aria-expanded="false">
                                <i class="fas fa-cogs"></i>
                            <span>{{ __(\Lang::get('Setting')) }}</span>
                        </a>

                        <ul class="collapse list-unstyled sub-menu" id="setting">
                            @permission('settings.general')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('settings.general') ? 'active' : '' }}" href="{{route('settings.general')}}">
                                    <span>{{ __('General') }}</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('settings.auth')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('settings.auth') ? 'active' : '' }}" href="{{route('settings.auth')}}">
                                    <span>{{ __('Auth & Registration') }}</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('settings.notifications')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('settings.notifications') ? 'active' : '' }}" href="{{route('settings.notifications')}}">
                                    <span>{{ __('Notifications') }}</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('location.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('location.index') ? 'active' : '' }}" href="{{route('location.index')}}">
                                    <span>{{ __(\Lang::get('Place')) }}</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('health_facility.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>1]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>1])}}">
                                    <span>@lang('health_facility')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('related_patient.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>260]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>260])}}">
                                    <span>@lang('related_patient')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('reason_testing.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>15]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>15])}}">
                                    <span>@lang('reason_testing')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('variant.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>279]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>279])}}">
                                    <span>@lang('variant')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('clinical_symptom.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>26]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>26])}}">
                                    <span>@lang('clinical_symptom')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('type_specimen.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>31]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>31])}}">
                                    <span>@lang('type_specimen')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('gender.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>35]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>35])}}">
                                    <span>@lang('gender')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('lab_center.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>39]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>39])}}">
                                    <span>@lang('lab_center')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('number_sample.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>47]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>47])}}">
                                    <span>@lang('number_sample')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('vaccination.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>58]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>58])}}">
                                    <span>@lang('vaccination')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('type_vaccine.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>64]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>64])}}">
                                    <span>@lang('type_vaccine')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('event_20.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>73]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>73])}}">
                                    <span>@lang('event_20')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('covid_patient.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>74]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>74])}}">
                                    <span>@lang('covid_patient')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('nation.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>78]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>78])}}">
                                    <span>@lang('nation')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('result.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>285]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>285])}}">
                                    <span>@lang('result')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('related_place.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>288]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>288])}}">
                                    <span>@lang('related_place')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('risk_level.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>292]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>292])}}">
                                    <span>@lang('Warning status')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('as.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>293]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>293])}}">
                                    <span>@lang('PatientAs')</span>
                                </a>
                            </li>
                            @endpermission
                            @permission('number_vaccine.index')
                            <li class="nav-item">
                                <a class="nav-link {{ url()->current()==route('common-codes.show',['id'=>333]) ? 'active' : '' }}" href="{{route('common-codes.show',['id'=>333])}}">
                                    <span>@lang('Number_vaccine')</span>
                                </a>
                            </li>
                            @endpermission
                        </ul>
                </li>
                @endpermission
        </ul>
    </div>
</nav>

