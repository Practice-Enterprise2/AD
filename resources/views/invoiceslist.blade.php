@extends('layouts.header')
<x-app-layout>
<style>
h1 {
    padding-top: 50px;
    text-align: center;
}
.userpanel{
    background: grey;
    width: 250px;
    margin-top: 25px;
    padding: 15px;
}
#searchfielddiv{
    margin: 0 auto;
    width: 250px;
    margin-top: 25px;
}
#searchfield{

    width: 250px;
}
#results div{
    margin-top: 25px;
    background-color: lightgray;
    width: 350px;
}
#searchResults div{
    width: 250px;
    height: 50px;
    background-color: lightgray;
    margin-top: 10px;

}
</style>
<script>
    //var check = "";
    //&& newArray[0] != check
    var fieldNames = ["Name", "customerID", "Order Number", "Price", "Freight","From Country", "From City", "From Zip", "From Street", "To Country", "To City", "To Zip", "To Street", "Invoice Date", "Due Date", "Total Price", "Created"];
    
    var array = @json($invoices);
    function show(id)
    {

        var results = document.getElementById("results");
        results.innerHTML = "";
        console.log(id);
        var id2 = document.getElementById(id);
        var arr = id2.getElementsByTagName('p');
        console.log(arr[1]);
        for(var d = 0; d < array.length; d++)
        {
            if(array[d][1] == arr[1].innerHTML)
            {
                var node = document.createElement("div");
                for(var b = 0; b < fieldNames.length; b++)
                {
                    var para = document.createElement("p");
                    para.innerHTML = fieldNames[b] + ": " + array[d][b];
                    node.appendChild(para);
                }
                results.appendChild(node);
            }
        }
    }
    function searchAll(){
        //&& !distinctArray.includes(newArray[i][1]) && !distinctArray.includes(newArray[i][2])
        var searchbox = document.getElementById("searchfield");
        
        var check = "not";
        var newArray = array.filter(element => element.includes(searchbox.value));
        var searchResultsSpot = document.getElementById("searchResults");
        if(newArray.length > 0)
        {
            var distinctArray = [];
            for(var i = 0; i< newArray.length; i++)
            {
                if(distinctArray.length == 0)
                {
                    distinctArray.push(newArray[i]);
                }
                for(var b = 0; b < distinctArray.length; b++)
                {
                    if(distinctArray[b][1] == newArray[i][1])
                    {
                        check = "in";
                    }
                }
                if(check == "not")
                {
                    distinctArray.push(newArray[i]);
                }
                check = "not";
                
            }
            console.log("distinct array");
            console.log(distinctArray);
            
            for(var c = 0; c < distinctArray.length; c++)
            {
                var node = document.createElement("div");
                //node.id = "div"+c;
                var node2 = document.createElement("p");
                node2.innerHTML = distinctArray[c][0];
                var node3 = document.createElement("p");
                node3.innerHTML = distinctArray[c][1];
                searchResultsSpot.appendChild(node);
                node.id = "div"+c
                node.appendChild(node2);
                node.appendChild(node3);
                node.setAttribute("onclick","show(this.id);");
                
            }
        }
        else{
            searchResultsSpot.innerHTML = "";
        }
    }
</script>
        
        <h1>Invoices List</h1>
        <div id="searchfielddiv">
        <input type="text" name="searchfield" id="searchfield" placeholder="Search" onkeyup="searchAll()">
        <div id="searchResults"></div>
        </div>
        <div id="results">
            
        </div>
       
        
</x-app-layout>