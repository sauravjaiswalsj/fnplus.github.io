<?php include 'head.php'; ?>

<h1 style="text-align:center;"><i class="icon-magic"></i> The Magic</h1>
<hr>
<h3>1. The First Try <span style="font-size:15px; font-weight:normal;">- Nearly a Year ago, It was 4 am and I had nothing to do.</span></h3>

<hr>
<div class="row-fluid">    
    <div class="span6" style="text-align:justify;">
    <p>I recently read about the dude who scraped the entire ICSE results, that got me going.
    I had a crack at this a several months ago, Maybe I wasn't thinking clearly at the time. Scraping
    data from any site is actually pretty simple, You just need to understand what's going on. I 
    started off by playing a litte with <a target="_blank"  href="https://code.google.com/p/v8/">V8</a><i>(A thing of beauty)</i>.
    I was trying to get what I wanted using the defined html selectors, I didn't know Jquery at the time, so I wrote a little JS code.
    This simply, Picks out our needle from the hay stack. 
    </p>  
    <hr />  
    <img src="img/magic1.png" width="70%" style="margin-left: 70px; margin-top:0px; margin-bottom: 0px;box-shadow: 0 0 6px #ccc;"/>
    <hr />
    <p>I wasn't really going anywhere with this. You'll need to login in with your register number and password, for this script to run from your
    browser. The ultimate aim was to make a AJAX call to my server and dump all the data there. Automating Logging-in seemed to be the problem.</p>

    <p>I came up with a partial solution which involved, storing register numbers and passwords in my database and sending them to evarsity via a HTTP GET call, like I've shown below
    <div class="well"><a href="#">http://evarsity.srmuniv.ac.in/srmswi/usermanager/youLogin.jsp?<br/>txtSN=1081020035&txtPD=myPassword&txtPA=1</a>.</div><br/>
    </p>    
    </div>
    <div class="span6" style="text-align:justify;">
    <pre>
    getStudentDetails(1);
    setTimeout(function(){
    var string=''; 
    var table = document.getElementsByTagName('table'); 
    var tr =table[1].getElementsByTagName('tr'); 
    var td =tr[1].getElementsByTagName('td'); 
    var name=td[1].innerhtml; 
    for(var i=1; i&lt;=10;i++) 
    { 
      var td =tr[i].getElementsByTagName('td'); 
      string= string + td[1].innerHTML+ '|'; 
    }
    var td =tr[11].getElementsByTagName('td');
    var x= td[1].getElementsByTagName('input'); 
    string= string + x[0].value + '|';
    for(i=12; i&lt;=15;i++) 
    { 
      var td =tr[i].getElementsByTagName('td'); 
      string= string + td[1].innerHTML+ '|'; 
    } 
    alert(string);
    },5000);
    </pre>
    <hr />
    <p>
    <code>txtSN</code>='Your Register Number' and <code>txtPD</code>='Your Password'. Right Click, View source and you can figure that out.
    </p>
    <p>
    I was unaware of concepts like PHP cURL at the time so, I popped this URL in a new window, and set up <a target="_blank"  href="https://addons.mozilla.org/en-US/firefox/addon/greasemonkey/">
    Greese Monkey</a> to parse and stash. The major issue with this predominantly Javascript Solution was that, It would run only on my PC and that too only on Mozilla and
    It was pretty much manual. 
    </p>
    </div>



</div>

<h3>2. The Right Way<span style="font-size:15px; font-weight:normal;">- A few days ago, I had a lot of things to do.</span></h3>
<hr>
<div class="row-fluid">    
<div class="span6" style="text-align:justify;">
<p>Over the last year, My knowledge about web technology has grown in leaps and bounds. With what little I know now, the problem at hand seemed very simple.
    Why not pick an alternative apporach? Then I realized the power of <a target="_blank"  href="http://curl.haxx.se/">cURL</a>. How can you emulate a browser action? That was 
    the question. Well actually, you can. cURL is Kick-Ass. Too bad it took so long for it to walk into my life. Lot of good things came about after un-installing
    windows, #SorryGates.</p>
</div>
</div>
<div class="row-fluid">    
  <div class="span6" style="text-align:justify;">
    
    <br/>

    <h4>Step-1, Log in to the ERP</h4>
    <hr>
    <p>I found a <a target="_blank"  href="https://github.com/lepunk/curl.class.php/blob/master/curl.class.php">php-cURL-class</a> somewhere on gitHub. Works perfectly, you just need to adjust 
    permission on that directory in Linux, no big deal. Then you're set.</p>
    <p>Think about it, What happens when you type in the Register Number, Password and click on login. The Contents from the text box are sent to a new URL through a simple
      HTTP GET/POST. cURL helps you automate this process. You can do it like this,</p>
<pre>
$cc = new cURL();
$data = $cc->get('evarsity.srmuniv.ac.in/srmswi/usermanager/
youLogin.jsp?txtSN='1081020035&txtPD=myPassword&txtPA=1');
// or you can even POST
$data = $cc->post('evarsity.srmuniv.ac.in/srmswi/usermanager/
youLogin.jsp',"txtSN=1081020035&txtPD=myPassword&txtPA=1");
echo $data;
</pre>
    <p><a href="#">Evarsity.Srmuniv.ac.in</a> uses a HTTP POST to transfer auth data, but the thing with JSP is it doesn't differentiate between a HTTP GET and a HTTP POST. Both methods work, unlike in PHP where you're likely to face an error. Weird. I'm still not able to figure out a reason to substantiate this behavior. As I said, Weird.</p>
    <br/>
    <h4>Step-3, Knowing what's wrong</h4>    
    <hr>
    <p>What will happen if the regno/password comination is wrong. How can we check this? There are only two possibilites, If the login is valid and if it isn't. We can check this
    by clues within the hyper-text. So if login is valid, the success page (i.e) your home page will have the details of the logged in student and it it's in valid it will
    have an error string <span class="text-error">"Login failed, Username and password do not match"</span>. We can look for such clues in the hyper-text to verify wether we have logged in properly.
    Checking for only one string may not be advisable, if the developers end up changing the hypertext a little, We are screwed! It's better we check for multiple cues.
    </p>
    

    <img src="img/magic2.png" width="100%" style="margin-left: 0px; margin-top:0px; margin-bottom: 0px;box-shadow: 0 0 6px #ccc;"/>

    </div>

  <div class="span6" style="text-align:justify;">
    <h4 style="margin-top:29px;">Step-2, Getting what we need</h4>    
    <hr>
    <p>Now that we're in, we need to scrape what we need. Remeber that basic information that shows up after logging into ERP, lets first scrape that. Again with the power of 
    the internet I found another useful tool a <a target="_blank"  href="http://simplehtmldom.sourceforge.net/">php DOM parser</a>. cURL returns only hyper-text. So using this parser we can 
    take what we need, Just like that. So for example, I need to get what's there in the 5th cell in 3rd row of the 2nd table in the page. I do it like this, </p>
<pre>
$html = str_get_html($data);  // $date is the result of cURL 
$table = $html->find('table');
$tr = $table[1]->find('tr');  // $table[1] is the 2nd table
$td = $tr[2]->find('td');  // $tr[2] is the 3rd row
echo $td[4]->plaintext;  // $td[4] is the fifth row
</pre>
    <p>Getting the Attd information isn't as straight forward. When you click on attendence, some AJAX stuff happens and the Attd is fetched from, </p>
    <div class="well"><a href="#">http://evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=7</a></div>

    <p>If you do a cURL to this url without logging in, you'll get a Apache Error. This is the important part, How is the server knowing wether I've logged in or not. I'm
    not specifying this information anywhere in the URL. It uses a JSESSIONID cookie,which is injected into the browser on login. You can see the value of this by typing <code>document.cookie
    </code> in v8. But you don't have to worry about this. cURL takes care of everything. It creates a text file cookies.txt which stores the JSESSIONID value after every successful 
    login. So cURL to the url mentioned, parse the HTML and you have your attendance information.</p>

    <p>Now that we have what we need, Now we do with it is up to us. I've written a set of APIs which are hosted on <a target="_blank"  href="https://openshift.redhat.com/">RhCloud</a><i>(A cool place to host your apps. No one else offers cloud space for free, I can tell you that!)</i> Which I've explained in detail <a target="_blank"  href="api.php">over here</a>. So you don't have do all this
    crap again, Just start off your application with my API's.</p>
    <br/>

    

    <h4>Step-4, That's it</h4>
    <hr>
    <p>We have successfully scraped SRM's ERP. Any queries, write to me at - <a target="_blank"  href="mailto:nithinkrishh@gmail.com">nithinkrishh@gmail.com</a>. My mother is standing behind my back
    and shouting at me for not preparing for the GRE. WTH? You do what you love. :)</p>


  </div>

</div>

<?php include 'foot.php'; ?>