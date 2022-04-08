
<script type="text/javascript">
                try {
                    ace.settings.loadState('main-container')
                } catch (e) {
                }
            </script>

            <div id="sidebar" class="sidebar responsive ace-save-state sidebar-fixed sidebar-scroll dropdown">
                <script type="text/javascript">
                    try {
                        ace.settings.loadState('sidebar')
                    } catch (e) {
                    }
                </script>

                <ul class="nav nav-list">
                    <li class="dropdown" id="m_home_page">
                        <a  href="{{url('/')}}" >
                            <i class="menu-icon glyphicon glyphicon-home"></i>
                            <span class="menu-text"> Welcome Page </span>
                        </a>

                        <b class="arrow"></b>

                    </li>
                    @if (session()->get('has_otorisasi'))
                      <li class="dropdown" id="m_transaksi">
                          <a  href="{{url('/transaksi')}}"  >
                              <i class="menu-icon glyphicon glyphicon-home"></i>
                              <span class="menu-text"> Voucher / Transaksi </span>
                          </a>

                          <b class="arrow"></b>

                      </li>
                      <li class="dropdown" id="m_bk">
                          <a  href="{{url('/bukti_pengeluaran')}}" >
                              <i class="menu-icon glyphicon glyphicon-home"></i>
                              <span class="menu-text"> Bukti Pengeluaran </span>
                          </a>

                          <b class="arrow"></b>

                      </li>
                      <li class="dropdown" id="m_bs">
                          <a  href="{{url('/bon_sementara')}}" >
                              <i class="menu-icon glyphicon glyphicon-home"></i>
                              <span class="menu-text"> Bon Sementara </span>
                          </a>

                          <b class="arrow"></b>

                      </li>
                      <li class="dropdown" id="m_bm">
                          <a  href="{{url('/bank_masuk')}}" >
                              <i class="menu-icon glyphicon glyphicon-home"></i>
                              <span class="menu-text"> Bank Masuk </span>
                          </a>

                          <b class="arrow"></b>

                      </li>
                      <li class="dropdown" id="m_pbs">
                          <a  href="{{url('/penyelesaian_bs')}}" >
                              <i class="menu-icon glyphicon glyphicon-home"></i>
                              <span class="menu-text"> Penyelesaian BS </span>
                          </a>

                          <b class="arrow"></b>

                      </li>
                      <li class="dropdown" id="m_approval_pajak">
                          <a  href="{{url('/approval_pajak')}}" >
                              <i class="menu-icon glyphicon glyphicon-home"></i>
                              <span class="menu-text"> Approval Pajak</span>
                          </a>

                          <b class="arrow"></b>

                      </li>
                      {{-- <li class="dropdown" id="m_approval_akunting">
                          <a  href="{{url('/approval_akunting')}}" >
                              <i class="menu-icon glyphicon glyphicon-home"></i>
                              <span class="menu-text"> Approval Akunting</span>
                          </a>

                          <b class="arrow"></b>

                      </li> --}}
                      <li class="dropdown" id="m_upload_berkas">
                          <a  href="{{url('/upload_berkas')}}" >
                              <i class="menu-icon glyphicon glyphicon-home"></i>
                              <span class="menu-text"> Berkas Pendukung </span>
                          </a>

                          <b class="arrow"></b>

                      </li>


                    @endif

                    <li class="dropdown" id="m_approval_pma">
                        <a  href="{{url('/approval_pma')}}" >
                            <i class="menu-icon glyphicon glyphicon-home"></i>
                            <span class="menu-text"> Approval PMA</span>
                        </a>

                        <b class="arrow"></b>

                    </li>
                    @if (session()->get('has_otorisasi'))

                    <li class="dropdown" id="m_pma">
                      <a href="{{url('/utility/pma_unit_kerja')}}" >
                            <i class="menu-icon glyphicon glyphicon-home"></i>
                            <span class="menu-text"> PMA & unit Kerja</span>


                        </a>

                        <b class="arrow"></b>

                    </li>
                  @endif
                      {{-- <li class="dropdown" id="m_cari_berkas">
                        <a  href="{{url('/cari_berkas')}}" >
                            <i class="menu-icon glyphicon glyphicon-home"></i>
                            <span class="menu-text"> Cari Berkas </span>
                        </a>

                        <b class="arrow"></b>

                    </li>
                    <li class="dropdown" id="m_upload_berkas">
                        <a  href="{{url('/upload_berkas')}}" >
                            <i class="menu-icon glyphicon glyphicon-home"></i>
                            <span class="menu-text"> Upload Berkas </span>
                        </a>

                        <b class="arrow"></b>

                    </li> --}}
                    {{-- <li class="dropdown" id="m_neraca">
                        <a href="{{url('/')}}" >
                            <i class="menu-icon glyphicon glyphicon-home"></i>
                            Neraca
                        </a>

                        <b class="arrow"></b>

                    </li> --}}

                    @if (session()->get('role_id') == '1')
                      <li class="dropdown" id="m_utility">
                          <a href="#" class="dropdown-toggle">
                              <i class="menu-icon fa fa-briefcase"></i>
                              <span class="menu-text">
                                  Utility
                              </span>

                              <b class="arrow fa fa-angle-down"></b>
                          </a>

                          <b class="arrow"></b>

                          <ul class="submenu">
                              {{-- <li class="" id="m_utility_user">
                                  <a href="{{url('/utility/pma_unit_kerja')}}" >
                                      <i class="menu-icon fa fa-caret-right"></i>
                                      Ganti PMA & unit Kerja
                                  </a>

                                  <b class="arrow"></b>

                              </li> --}}
                              <li class="" id="m_utility_user">
                                  <a href="{{url('/utility/otorisasi_user')}}" >
                                      <i class="menu-icon fa fa-caret-right"></i>
                                      Otorisasi User
                                  </a>

                                  <b class="arrow"></b>

                              </li>
                              <li class="" id="m_utility_user">
                                  <a href="{{url('/utility/user')}}" >
                                      <i class="menu-icon fa fa-caret-right"></i>
                                      Whitelist User
                                  </a>

                                  <b class="arrow"></b>

                              </li>
                              <li class="" id="m_utility_logs">
                                  <a href="{{url('/utility/log_user')}}" >
                                      <i class="menu-icon fa fa-caret-right"></i>
                                      Logs User
                                  </a>

                                  <b class="arrow"></b>

                              </li>
                          </ul>
                      </li>
                    @endif

                </ul><!-- /.nav-list -->

                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>
            </div>
