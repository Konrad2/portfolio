function zapisz(t) {
    if (t == "WyborKursu") {
        var dataW = document.getElementById("DataW");
        if (!SprData(dataW.value)) { alert(info201); return }


        var dw = new Date(parseInt(dataW.value.substr(0, 4)), parseInt(UsunZera(dataW.value.substr(5, 2))) - 1, parseInt(UsunZera(dataW.value.substr(8, 2))));
        var dzis = new Date();
        var data_spr = new Date(dzis.getYear() < 1900 ? dzis.getYear() + 1900 : dzis.getYear(), dzis.getMonth(), dzis.getDate());

        if (data_spr > dw) {
            alert(info203);
            return
        }
 
        var miastoZW = document.getElementById("MiastoZW");
        var miastoDoW = document.getElementById("MiastoDoW");
        document.getElementById("MiastoZWN").value = miastoZW.options[miastoZW.selectedIndex].text;
        document.getElementById("MiastoDoWN").value = miastoDoW.options[miastoDoW.selectedIndex].text;
 
        var dataP = document.getElementById("DataP");
        if (dataP) {
            if (!document.getElementById("Op").checked) {
                if (!SprData(dataP.value)) { alert(info201); return }
                var dp = new Date(parseInt(dataP.value.substr(0, 4)), parseInt(UsunZera(dataP.value.substr(5, 2))) - 1, parseInt(UsunZera(dataP.value.substr(8, 2))));
                if (dw > dp) { alert(info202); return }
            }
            var miastoZP = document.getElementById("MiastoZP");
            var miastoDoP = document.getElementById("MiastoDoP");
            document.getElementById("MiastoZPN").value = miastoZP.options[miastoZP.selectedIndex].text;
            document.getElementById("MiastoDoPN").value = miastoDoP.options[miastoDoP.selectedIndex].text;
        }
        document.getElementById('komunikat').style.display = 'block';
    }

    if (t == "WyborKrajow")
        document.getElementById('komunikat_all').style.display = 'block';

    document.getElementById('ContentBusOnLine').style.display = 'none';
    document.getElementById("tryb").value = t;
    document.forms[0].submit();    
}