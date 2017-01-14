<div class="row">
         <div class="col-md-8 col-sm-8 col-lg-8 ">

           <h4>ANALYTICS DASHBOARD</h4>

         </div>
         </div>
          

            <div class="clearfix"></div>






          <div  class="row">
            <div class="col-md-4 col-sm-4 col-lg-4 ">
    
              <div class="ccms_form_element cfdiv_custom" id="style_container_div">
                <label>Client:</label><select class="dropdown"  size="1" id="beerStyle"  type="select" name="style">
                <option value="">-Choose A Client-</option>
                <option value="Ale">Pepsi /</option>
                <option value="Lager">Ebryx</option>
                <option value="Hybrid">Intel</option>
                </select><div class="clear"></div><div id="error-message-style"></div></div>
              </div>  

               <div class="col-md-4 col-sm-4 col-lg-6">

                <div id="Ale"  class="style-sub-1"  style="display: none;" name="stylesub1">
                  <label>Project</label>
                    <select class="selectpicker show-menu-arrow">
                      <option value="">-Choose An Project-</option> 
                      <option value="re">1 xyzyz</option>
                      <option value="re">2 xyzxyz</option>
                      <option value="re">3xyzxyz</option>                     
                    </select>
                </div>

                <div id="Lager"  class="style-sub-1"  style="display: none;" name="stylesub1" >
                  <label>Project:</label>
                    <select>
                    <option value="">-Choose A Project-</option>
                      <option value="re">1_new</option>
                      <option value="re">2_bro</option>
                      <option value="re">3_max</option>
                     
                    </select>
                </div>
                <div id="Hybrid"  class="style-sub-1"  style="display: none;" name="stylesub1" >
                  <label>Project</label> 
                    <select>
                    <option value="">-Choose A Project-</option>
                      <option value="re">1----zip</option>
                      <option value="re">2----spicy</option>
                      <option value="re">3-----bravo</option>
                    </select>
                </div><div class="clear"></div><div id="error-message-style-sub-1"></div>
                </div>

             </div>  
           

           
            <!-- <div id="blah" class=""> -->
            <div class="row">
              <div class="">

              <br />

               <div>
               <div class="progress-bar progress-bar-success" role="progressbar" style="width:25%">
               Open Ports <br /> {{ $open_ports }}
               </div>
               <div class="progress-bar progress-bar-warning" role="progressbar" style="width:25%">
               Vulnerabilities <br /> {{ $open_ports }}
               <!-- This can be count of plugin id's tested for possible vulnerbaility -->
               <!-- Possible Vulnerabilities -->
               </div>
               <div class="progress-bar progress-bar-danger" role="progressbar" style="width:25%">
               Active Systems<br /> {{ $reporthosts_count }}
               </div>
<!--                <div class="progress-bar progress-bar-info" role="progressbar" style="width:25%">
               Systems compromised <br />18 -->
               <div class="progress-bar progress-bar-info" role="progressbar" style="width:25%">
               Systems at Highest Risk <small>(Risk Factor)</small> <br /> {{ $systems_at_risk }}
               </div>
               </div>



          







               </div>
               </div>
               <br />
                 <div class="row">

                <div class="clearfix"></div>
              <div class="col-md-4 col-sm-6 col-lg-6">
                <div class="x_panel">
                  <div class="x_title">
                    <!-- <h2>Critical Severity ka count in each Ip <small>Sessions</small></h2> -->
                    <!-- <h2>Count of critical severity  <small>Sessions</small></h2> -->
                    <!-- <h2>Ip's having critical severity<small>Sessions</small></h2> -->
                    <!-- <h2>Summary Critical Ip <small>Sessions</small></h2> -->
                    <!-- <h2>Critical Ip Summary<small>Sessions</small></h2> -->

                    <h2>Most Vulnerable Machines <small>(Severity)</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="pieChart"></canvas>
                  </div>
                </div>
              </div>

              <div class="col-md-4 col-sm-6 col-lg-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Vulnerabilities Summary <small>(Risk Factor)</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="canvasDoughnut"></canvas>
                  </div>
                </div>
              </div>
                <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Line graph<small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="lineChart"></canvas>
                  </div>
                </div>
              </div>
    <!-- Added line here -->
    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Top 10 Compromised Machines <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="bar_compromised_machines"></canvas>
                  </div>
                </div>
              </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Top 10 (Potential) Vulnerabilities <small>(Sessions)</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="mybarChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
            </div>
               </div>
               </div>
              

             
           

           
                    </div> 
        <!-- /page content -->

        <!-- footer content -->
        <footer>
         
        </footer>
        <!-- /footer content -->
      </div>