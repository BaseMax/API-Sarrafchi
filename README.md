# API Sarrafchi

Sarrafchi: API and web service to get live currency rates in Free Market.

## Using

```
<div class="row">
    <div class="col-md-4">
        <div class="price-box"><strong>US Dollar: </strong> <span id="price_usd">&#8211;</span> <small>تومان</small></div>
        <div class="price-box"><strong>Euro: </strong> <span id="price_euro">&#8211;</span> <small>تومان</small></div>
        <div class="price-box"><strong>British Pound: </strong> <span id="price_pound">&#8211;</span> <small>تومان</small></div>
    </div>
    <div class="col-md-4">
        <div class="price-box"><strong>Swiss Franc: </strong> <span id="price_franc">&#8211;</span> <small>تومان</small></div>
        <div class="price-box"><strong>Canadian Dollar: </strong> <span id="price_canad">&#8211;</span> <small>تومان</small></div>
        <div class="price-box"><strong>Australian Dollar: </strong> <span id="price_austr">&#8211;</span> <small>تومان</small></div>
    </div>
    <div class="col-md-4">
        <div class="price-box"><strong>Swedish Krona: </strong> <span id="price_krona">&#8211;</span> <small>تومان</small></div>
        <div class="price-box"><strong>Norwegian Krone: </strong> <span id="price_norwkrona">&#8211;</span> <small>تومان</small></div>
        <div class="price-box"><strong>Russian Ruble: </strong> <span id="price_ruble">&#8211;</span> <small>تومان</small></div>
    </div>
</div>
<script type="text/javascript">
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {
    	let obj = JSON.parse(this.responseText);
    	document.querySelector("#price_usd").innerHTML=obj.currencies["US Dollar"].sell;
    	document.querySelector("#price_euro").innerHTML=obj.currencies["Euro"].sell;
    	document.querySelector("#price_pound").innerHTML=obj.currencies["British Pound"].sell;
    	document.querySelector("#price_franc").innerHTML=obj.currencies["Swiss Franc"].sell;
    	document.querySelector("#price_canad").innerHTML=obj.currencies["Canadian Dollar"].sell;
    	document.querySelector("#price_austr").innerHTML=obj.currencies["Australian Dollar"].sell;
    	document.querySelector("#price_krona").innerHTML=obj.currencies["Swedish Krona"].sell;
    	document.querySelector("#price_norwkrona").innerHTML=obj.currencies["Norwegian Krone"].sell;
    	document.querySelector("#price_ruble").innerHTML=obj.currencies["Russian Ruble"].sell;
    }
};
xhttp.open("GET", "https://api.sarrafchi.ir/rate/", true);
xhttp.send();
</script>
```
---------

# Max Base

My nickname is Max, Programming language developer, Full-stack programmer. I love computer scientists, researchers, and compilers. ([Max Base](https://maxbase.org/))

## Asrez Team

A team includes some programmer, developer, designer, researcher(s) especially Max Base.

[Asrez Team](https://www.asrez.com/)

