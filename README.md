# ImageMap Free Image Mapping Tool With CSS
<hr>
Check Demo : <a href="https://www.imagemap.in/"> www.imagemap.in </a>
<br>
<p>Quick ImageMap is an advance image mapping tool for web developer,<br>
 it will helps in easy image mapping  with coordinates also create custom CSS.<br>
 Upload your image and click on clickable areas,
Image mapping tool will perform ton of your task for FREE !!</p>

##Ever you read e-paper ?
<br>
When you read e-paper you can see the actual effect of image mapping, a single image with many links with coordinates mapping!! <br>
<img src="https://www.imagemap.in/img/epaper.gif">
<br>
or
<br>
##or Tried these things in your development ?
<br>
<img src="https://www.imagemap.in/img/social.gif">
<br>
<img src="https://www.imagemap.in/img/map.gif">
<br>
##You did lot's of CSS or Codes for same ?
<br>
Now it's over, you can do ton of task quick and free ! <br>
Just upload and Image, Start Mapping with CSS and copy Generated code, watch below video for more info: <br>
<br>
[![Advanced Image Map Tool](https://raw.githubusercontent.com/himstar/ImageMap/master/images/github.PNG)](http://www.youtube.com/watch?v=waUY9mjTOwQ)
<br>
--File uploaded on server saved for next 16 hrs.
<br>
#How it Works ?
<br> By using this script user can select image path along with coordinates. Script generate perfect coordinates HTML and required codes for you. You can also add custom css for styling your marked area.
<br>
## Uses:
Copy generated code and use in following way (without CSS)
<br>
```ruby
<img src="Your_Image_URL" alt="QuickMap" class="QuickMap" usemap="#QuickMap" />
<map name="QuickMap" id="QuickMap">
    <area alt="" title="" href="#" shape="poly" coords="121,252,129,224,121,189,136,156,172,143,217,156,255,145,301,169,340,210,316,234,327,268,332,304,328,318,326,364,326,382,332,387,332,402,337,415,339,443,338,477,340,494,345,508,342,510,342,524,341,538,329,542,313,542,297,528,300,505,294,513,282,518,271,523,266,530,275,535,276,543,280,547,157,550,164,520,155,515,139,508,132,505,131,511,139,521,136,531,126,540,110,538,103,536,99,522,97,501,104,483,102,408,105,401,109,373,111,303,106,283" />
    <area alt="" title="" href="#" shape="poly" coords="406,174,417,133,445,103,464,88,497,75,538,77,580,92,605,110,617,139,620,149,622,168,627,180,633,190,633,198,625,215,628,245,627,284,628,319,625,350,626,387,627,399,637,406,638,415,640,422,641,434,640,440,638,448,637,474,635,494,645,500,642,514,636,535,607,542,589,520,577,521,582,534,592,547,459,547,439,516,441,535,411,540,391,518,404,391,411,366,411,218" />
    <area../>
</map>
```
<br>
#With CSS (You should use ajax)
Ex-
```ruby
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
```
 <br>
```ruby
<img src="Your_Image_URL.jpg" alt="QuickMap" class="QuickMap" usemap="#QuickMap" />
<map name="QuickMap" id="QuickMap">
    <area alt="" title="" href="#" shape="poly" coords="121,252,129,224,121,189,136,156,172,143,217,156,255,145,301,169,340,210,316,234,327,268,332,304,328,318,326,364,326,382,332,387,332,402,337,415,339,443,338,477,340,494,345,508,342,510,342,524,341,538,329,542,313,542,297,528,300,505,294,513,282,518,271,523,266,530,275,535,276,543,280,547,157,550,164,520,155,515,139,508,132,505,131,511,139,521,136,531,126,540,110,538,103,536,99,522,97,501,104,483,102,408,105,401,109,373,111,303,106,283" />
    <area alt="" title="" href="#" shape="poly" coords="406,174,417,133,445,103,464,88,497,75,538,77,580,92,605,110,617,139,620,149,622,168,627,180,633,190,633,198,625,215,628,245,627,284,628,319,625,350,626,387,627,399,637,406,638,415,640,422,641,434,640,440,638,448,637,474,635,494,645,500,642,514,636,535,607,542,589,520,577,521,582,534,592,547,459,547,439,516,441,535,411,540,391,518,404,391,411,366,411,218" />
    <area../>
</map>
<script type="text/javascript">
    function QuickImageMap(){
        $.fn.QuickMap.defaults = {
        fill: true,
        // fillColor: '000000',
        fillOpacity: 0,
        stroke: true,
        strokeColor: 'F05F40',
        strokeOpacity: 1,
        strokeWidth: 6,
        fade: true,
        alwaysOn: false,
        neverOn: false,
        groupBy: false,
        wrapClass: true,
        // plenty of shadow:
        shadow: false,
        shadowX: 0,
        shadowY: 0,
        shadowRadius: 6,
        // shadowColor: '000000',
        shadowOpacity: 0.8,
        shadowPosition: 'outside',
        shadowFrom: false
        }
    };
    $(function() {
        $('.QuickMap').QuickMap({
            fillColor: 'ffffff'
        });
    });
</script>
<script type="text/javascript" src="https://www.imagemap.in/quickmap/QuickMap.js"></script> 
```
<br>
Above selected script and JS convert selected area into Canvas for effects (you can also add other canvas properties after few modifications)
<br>
##Contributions:
<br>
Plugin Used: Uploadify, Maphighlight <br>
Technology Used: HTML, CSS, JQuery & PHP <br>
Frameworks Used: Bootstrap, AngularJs, Jquery UI <br>
Cloud Sever & SSL: Managed by CloudFlare <br>
Developed By: <a href="https://www.himstar.info"> Himanshu Dhiraj Mishra </a><br>
(GitHub shared source code missing templete files due to licence issue, you need to import it manumally)

