<?php include 'head.php'; ?>

<div class="row-fluid">
	<center><h2><i class="icon-beaker"></i> API</h2></center>
	<hr/>
</div>
<div class="row-fluid">
        <div class="span7 well" style="text-align:justify;" id="get_check">                
                <div class="form-inline">
                <h3>Check Login</h3>                                    
                <input type="text" name="regno" class="span4" placeholder="Your Register Number" autocomplete="off" />&nbsp;&nbsp;
                <input type="password" name="pass" class="span4" placeholder="Your ERP Password" autocomplete="off" />&nbsp;&nbsp;                         
                <button class="btn btn-info " type="submit">Verify <i class="icon-refresh icon-spin" style="display:none;"></i></button>&nbsp;&nbsp;                                         
        </div>        
        <hr />
        <div class="json_response_success" style="display:none;">
                <span class="label label-success">JSON-Success</span>
                { <br/>
                &nbsp;&nbsp;<strong>login</strong>: <span class="text-success">success</span>,<br/>
                &nbsp;&nbsp;<strong>error</strong>: <span class="text-success">false</span><br/>               
                }
                <br/><strong>Time </strong><span class="time muted"></span>
        </div>
        <div class="json_response_failure" style="display:none;">
                <span class="label label-important">JSON-Failure</span>
                { <br/>
                &nbsp;&nbsp;<strong>error</strong> : <span class="error text-error"></span><br/>                
                &nbsp;&nbsp;<strong>code</strong> : <span class="code text-error"></span><br/>                
                }
                <br/><strong>Time </strong><span class="time muted"></span>
        </div>
        </div>
<div class="span5">
<pre>
curl "http://srmapi-hmm.rhcloud.com/get-check.php" \
--data "regno=1081020035" \ 
--data "pass=myPassword" \
</pre>              
Possible Error Codes : <label class="label ">100</label>&nbsp;<label class="label ">200</label>&nbsp;<label class="label ">500</label>    
<br /><a class="link" href="#myModal" data-toggle="modal">View Error Codes</a>
</div>
</div>
<hr />
<div class="row-fluid">
	<div class="span7 well" style="text-align:justify;" id="get_info">
		
		<div class="form-inline">
			<h3>Get Student Information</h3>	
                <input type="text" name="regno" class="span4" placeholder="Your Register Number" autocomplete="off" />&nbsp;&nbsp;
                <input type="password" name="pass" class="span4" placeholder="Your ERP Password" autocomplete="off" />&nbsp;&nbsp;                         
                <button class="btn btn-info " type="submit">Fetch My Data <i class="icon-refresh icon-spin" style="display:none;"></i></button>
        </div>        
        <hr />
        <div class="json_response_success" style="display:none;">
        	<span class="label label-success">JSON-Success</span>
        	{ <br/>
        	&nbsp;&nbsp;<strong>name</strong>: <span class="name text-success"></span>,<br/>
        	&nbsp;&nbsp;<strong>regno</strong>: <span class="regno text-success"></span>,<br/>
        	&nbsp;&nbsp;<strong>course</strong> : <span class="course text-success"></span>,<br/>
            &nbsp;&nbsp;<strong>studentid</strong> : <span class="studentid text-success"></span>,<br/>
            &nbsp;&nbsp;<strong>semester</strong> : <span class="semester text-success"></span>,<br/>
            &nbsp;&nbsp;<strong>year</strong> : <span class="year text-success"></span>,<br/>
        	&nbsp;&nbsp;<strong>email</strong> : <span class="email text-success"></span>,<br/>
        	&nbsp;&nbsp;<strong>dob</strong> : <span class="dob text-success"></span>,<br/>
        	&nbsp;&nbsp;<strong>sex</strong> : <span class="sex text-success"></span>,<br/>
        	&nbsp;&nbsp;<strong>adress</strong> : <span class="address text-success"></span>,<br/>
        	&nbsp;&nbsp;<strong>pincode</strong> : <span class="pincode text-success"></span>,<br/>
        	&nbsp;&nbsp;<strong>error</strong> : <span class="error text-success"></span><br/>
        	}
            <br/><strong>Time</strong><span class="time muted"></span>
        </div>
        <div class="json_response_failure" style="display:none;">
        	<span class="label label-important">JSON-Failure</span>
        	{ <br/>
        	&nbsp;&nbsp;<strong>error</strong> : <span class="error text-error"></span><br/>        	
            &nbsp;&nbsp;<strong>code</strong> : <span class="code text-error"></span><br/>                
        	}
            <br/><strong>Time </strong><span class="time muted"></span>
        </div>
	</div>
<div class="span5">
<pre>
curl "http://srmapi-hmm.rhcloud.com/get-info.php" \
--data "regno=1081020035" \ 
--data "pass=myPassword" \
</pre>			
Possible Error Codes : <label class="label ">100</label>&nbsp;<label class="label ">200</label>&nbsp;<label class="label ">300</label>
&nbsp;<label class="label ">301</label>&nbsp;<label class="label ">500</label>&nbsp;<label class="label ">707</label>        
<br /><a class="link" href="#myModal" data-toggle="modal">View Error Codes</a>
</div>
</div>
<hr />
<div class="row-fluid">
	<div class="span7 well" style="text-align:justify;"  id="get_attd">		
		<div class="form-inline">
			<h3>Get Attendance Information</h3>			
                <input type="text" name="regno" class="span4" placeholder="Your Register Number" autocomplete="off" />&nbsp;&nbsp;
                <input type="password" name="pass" class="span4" placeholder="Your ERP Password" autocomplete="off" />&nbsp;&nbsp;                         
                <button class="btn btn-info " type="submit">Fetch My Attd Data <i class="icon-refresh icon-spin" style="display:none;"></i></button>
        </div>        
        <hr />
        <div class="json_response_success" style="display:none;">
        	<span class="label label-success">JSON-Success</span>        	
        </div>
        <div class="json_response_failure" style="display:none;">
        	<span class="label label-important">JSON-Failure</span>
        	{ <br/>
        	&nbsp;&nbsp;<strong>error</strong> : <span class="error text-error"></span><br/>        	
            &nbsp;&nbsp;<strong>code</strong> : <span class="code text-error"></span><br/>                
        	}
            <br/><strong>Time </strong><span class="time muted"></span>
        </div>
	</div>
<div class="span5">
<pre>
curl "http://srmapi-hmm.rhcloud.com/get-attd.php" \
--data "regno=1081020035" \ 
--data "pass=myPassword" \
</pre>			
Possible Error Codes : <label class="label ">100</label>&nbsp;<label class="label ">200</label>
&nbsp;<label class="label ">302</label>&nbsp;<label class="label ">500</label>    
<br /><a class="link" href="#myModal" data-toggle="modal">View Error Codes</a>
</div>
</div>
<hr/>
<div class="row-fluid">
        <div class="span7 well" style="text-align:justify;" id="get_tt">                
                <div class="form-inline">
                <h3>Get Student Time Table</h3>                        
                <input type="text" name="regno" class="span4" placeholder="Your Register Number" autocomplete="off" />&nbsp;&nbsp;
                <input type="password" name="pass" class="span4" placeholder="Your ERP Password" autocomplete="off" />&nbsp;&nbsp;                         
                <button class="btn btn-info " type="submit">Fetch Time Table<i class="icon-refresh icon-spin" style="display:none;"></i></button>
        </div>        
        <hr />
        <div class="json_response_success" style="display:none;">
                <span class="label label-success">JSON-Success</span>
                { <br/>
                &nbsp;&nbsp;<strong>monday</strong>: [<span class="monday text-success"></span>],<br/>
                &nbsp;&nbsp;<strong>tuesday</strong>: [<span class="tuesday text-success"></span>],<br/>
                &nbsp;&nbsp;<strong>wednesday</strong>: [<span class="wednesday text-success"></span>],<br/>
                &nbsp;&nbsp;<strong>thursday</strong>:[<span class="thursday text-success"></span>],<br/>
                &nbsp;&nbsp;<strong>friday</strong>: [<span class="friday text-success"></span>]<br/>
                }
                <br/><strong>Time </strong><span class="time muted"></span>
        </div>
        <div class="json_response_failure" style="display:none;">
                <span class="label label-important">JSON-Failure</span>
                { <br/>
                &nbsp;&nbsp;<strong>error</strong> : <span class="error text-error"></span><br/>                
                &nbsp;&nbsp;<strong>code</strong> : <span class="code text-error"></span><br/>                
                }
                <br/><strong>Time </strong><span class="time muted"></span>
        </div>
        </div>
<div class="span5">
<pre>
curl "http://srmapi-hmm.rhcloud.com/get-tt.php" \
--data "regno=1081020035" \ 
--data "pass=myPassword" \
</pre>                  
Possible Error Codes : <label class="label ">100</label>&nbsp;<label class="label ">200</label>
&nbsp;<label class="label ">303</label>&nbsp;<label class="label ">500</label>    
<br /><a class="link" href="#myModal" data-toggle="modal">View Error Codes</a>
</div>
</div>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:730px; left:44%;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Error Codes</h3>
  </div>
  <div class="modal-body">        
                <table class="table table-bordered table-hover">
                <thead>
                        <tr><th>Code</th><th style="width:160px;">Error Message</th><th>Error Description</th></tr>
                </thead>
                <tbody>
                        <tr>
                                <th>100</th>
                                <td>Wrong Regno Password</td>
                                <td>The Register Number doesn't match the password as in the SRM ERP.</td>
                        </tr>
                        <tr>
                                <th>200</th>
                                <td>Unable to connect to SRM HOME</td>
                                <td>The Server wasn't able to connect to <a href="#">evarsity.srmuniv.ac.in/srmswi/usermanager/home.jsp</a>, thus failed to log on to the server.</td>
                        </tr>
                        <tr>
                                <th>300</th>
                                <td>Unable to connect to Student Detais</td>
                                <td>The Server wasn't able to connect to <a href="#">evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=7</a>, thus 
                                unable to fetch the given Student's Basic information.</td>
                        </tr>
                        <tr>
                                <th>301</th>
                                <td>Unable to connect to Additional Details</td>
                                <td>The Server wasn't able to connect to <a href="#">evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=21</a>, thus 
                                unable to fetch the given Student's Additional information.</td>
                        </tr>
                        <tr>
                                <th>302</th>
                                <td>Unable to connect to Attd Detais</td>
                                <td>The Server wasn't able to connect to <a href="#">evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=5</a>, thus 
                                unable to fetch the given student's attendance information.</td>
                        </tr>                        
                        <tr>
                                <th>303</th>
                                <td>Unable to connect to TimeTable Detais</td>
                                <td>The Server wasn't able to connect to <a href="#">evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=5</a>, thus 
                                unable to fetch the given student's time-table information.</td>                                
                        </tr>                                                
                        <tr>
                                <th>500</th>
                                <td>Something Went Wrong</td>
                                <td>HTTP POST error. Input selectors should match.</td>                                
                        </tr>
                        <tr>
                                <th>707</th>
                                <td>Unable to Download File from ERP</td>
                                <td>The Server was unable to download, student image from the ERP.</td>                                
                        </tr>
                        <tr>
                                <th>901</th>
                                <td>Unable to call INFO API</td>
                                <td>Error while calling get-info</td>                                
                        </tr>
                        <tr>
                                <th>902</th>
                                <td>Unable to call TT API</td>
                                <td>Error while calling get-tt</td>                                
                        </tr>
                        <tr>
                                <th>903</th>
                                <td>Unable to call ATTD API</td>
                                <td>Error while calling get-tt</td>                                                                
                        </tr>
                        <tr>
                                <th>904</th>
                                <td>Unable to call CHECK API</td>
                                <td>Error while calling get-check</td>                                                                
                        </tr>
                </tbody>                                
                </table>                  
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>    
  </div>
</div>
<?php include 'foot.php'; ?>