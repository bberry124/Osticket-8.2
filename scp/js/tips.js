jQuery(function() {
    var showtip = function (url, elem,xoffset) {

            var pos = elem.offset();
            var y_pos = pos.top - 12;
            var x_pos = pos.left + (xoffset || (elem.width() + 16));

            var tip_arrow = $('<img>').attr('src', './images/tip_arrow.png').addClass('tip_arrow');
            var tip_box = $('<div>').addClass('tip_box');
            var tip_shadow = $('<div>').addClass('tip_shadow');
            var tip_content = $('<div>').addClass('tip_content').load(url, function() {
                tip_content.prepend('<a href="#" class="tip_close"><i class="icon-remove-circle"></i></a>').append(tip_arrow);
            var width = $(window).width(),
                rtl = $('html').hasClass('rtl'),
                size = tip_content.outerWidth(),
                left = the_tip.position().left,
                left_room = left - size,
                right_room = width - size - left,
                flip = rtl
                    ? (left_room > 0 && left_room > right_room)
                    : (right_room < 0 && left_room > right_room);
                if (flip) {
                    the_tip.css({'left':x_pos-tip_content.outerWidth()-elem.width()-32+'px'});
                    tip_box.addClass('right');
                    tip_arrow.addClass('flip-x');
                }
            });

            var the_tip = tip_box.append(tip_content).prepend(tip_shadow);
            the_tip.css({
                "top":y_pos + "px",
                "left":x_pos + "px"
            }).addClass(elem.data('id'));
            $('.tip_box').remove();
            $('body').append(the_tip.hide().fadeIn());
            $('.' + elem.data('id') + ' .tip_shadow').css({
                "height":$('.' + elem.data('id')).height() + 5
            });
    },
    getHelpTips = (function() {
        var dfd, cache = {};
        return function(namespace) {
            var namespace = namespace
                || $('#content').data('tipNamespace')
                || $('meta[name=tip-namespace]').attr('content');
            if (!namespace)
                return $.Deferred().resolve().promise();
            else if (!cache[namespace])
                cache[namespace] = {
                  dfd: dfd = $.Deferred(),
                  ajax: $.ajax({
                    url: "ajax.php/help/tips/" + namespace,
                    dataType: 'json',
                    success: $.proxy(function (json_config) {
                        this.resolve(json_config);
                    }, dfd)
                  })
                }
            return cache[namespace].dfd;
        };
    })();

    var tip_id = 1;
    //Generic tip.
    $('.tip')
    .live('click mouseover', function(e) {
        e.preventDefault();
        if (!this.rel)
            this.rel = 'tip-' + (tip_id++);
        var id = this.rel,
            elem = $(this);

        elem.data('id',id);
        elem.data('timer',0);
        if ($('.' + id).length == 0) {
            if (e.type=='mouseover') {
                // wait about 1 sec - before showing the tip - mouseout kills
                // the timeout
                elem.data('timer',setTimeout(function() {
                    showtip('ajax.php/content/'+elem.attr('href').substr(1),elem);
                },750));
            } else {
                showtip('ajax.php/content/'+elem.attr('href').substr(1),elem);
            }
        }
    })
    .live('mouseout', function(e) {
        clearTimeout($(this).data('timer'));
    });

    $('.help-tip')
    .live('mouseover click', function(e) {
        e.preventDefault();

        var elem = $(this),
            pos = elem.offset(),
            y_pos = pos.top - 8,
            x_pos = pos.left + elem.width() + 16,
            tip_arrow = $('<img>')
                .attr('src', './images/tip_arrow.png')
                .addClass('tip_arrow'),
            tip_box = $('<div>')
                .addClass('tip_box'),
            tip_content = $('<div>')
                .append('<a href="#" class="tip_close"><i class="icon-remove-circle"></i></a>')
                .addClass('tip_content'),
            the_tip = tip_box
                .append(tip_content.append(tip_arrow))
                .css({
                    "top":y_pos + "px",
                    "left":x_pos + "px"
                }),
            tip_timer = setTimeout(function() {
                $('.tip_box').remove();
                $('body').append(the_tip.hide().fadeIn());
                var width = $(window).width(),
                    rtl = $('html').hasClass('rtl'),
                    size = tip_content.outerWidth(),
                    left = the_tip.position().left,
                    left_room = left - size,
                    right_room = width - size - left,
                    flip = rtl
                        ? (left_room > 0 && left_room > right_room)
                        : (right_room < 0 && left_room > right_room);
                if (flip) {
                    the_tip.css({'left':x_pos-tip_content.outerWidth()-40+'px'});
                    tip_box.addClass('right');
                    tip_arrow.addClass('flip-x');
                }
            }, 500);

        elem.live('mouseout', function() {
            clearTimeout(tip_timer);
        });

        getHelpTips().then(function(tips) {
            var href = elem.attr('href');
            if (href) {
                section = tips[elem.attr('href').substr(1)];
            }
            else if (elem.data('content')) {
                section = {title: elem.data('title'), content: elem.data('content')};
            }
            else {
                elem.remove();
                clearTimeout(tip_timer);
                return;
            }
            if (!section)
                return;
            tip_content.append(
                $('<h1>')
                    .append('<i class="icon-info-sign faded"> ')
                    .append(section.title)
                ).append(section.content);
            if (section.links) {
                var links = $('<div class="links">');
                $.each(section.links, function(i,l) {
                    var icon = l.href.match(/^http/)
                        ? 'icon-external-link' : 'icon-share-alt';
                    links.append($('<div>')
                        .append($('<a>')
                            .html(l.title)
                            .prepend('<i class="'+icon+'"></i> ')
                            .attr('href', l.href).attr('target','_blank'))
                    );
                });
                tip_content.append(links);
            }
        });
        $('.tip_shadow', the_tip).css({
            "height":the_tip.height() + 5
        });
    });

    //faq preview tip
    $('.previewfaq').live('mouseover', function(e) {
        e.preventDefault();
        var elem = $(this);

        var vars = elem.attr('href').split('=');
        var url = 'ajax.php/kb/faq/'+vars[1];
        var id='faq'+vars[1];
        var xoffset = 100;

        elem.data('id',id);
        elem.data('timer',0);
        if($('.' + id).length == 0) {
            if(e.type=='mouseover') {
                 /* wait about 1 sec - before showing the tip - mouseout kills the timeout*/
                 elem.data('timer',setTimeout(function() { showtip(url,elem,xoffset);},750))
            }else{
                showtip(url,elem,xoffset);
            }
        }
    }).live('mouseout', function(e) {
        clearTimeout($(this).data('timer'));
    });


    $('a.collaborators.preview').live('mouseover', function(e) {
        e.preventDefault();
        var elem = $(this);

        var url = 'ajax.php/'+elem.attr('href').substr(1)+'/preview';
        var xoffset = 100;
        elem.data('timer', 0);

        if (e.type=='mouseover') {
            elem.data('timer',setTimeout(function() { showtip(url, elem, xoffset);},750))
        } else {
            showtip(url,elem,xoffset);
        }
    }).live('mouseout', function(e) {
        clearTimeout($(this).data('timer'));
    }).live('click', function(e) {
        clearTimeout($(this).data('timer'));
        $('.tip_box').remove();
    });


    //Ticket preview
    $('.ticketPreview').live('mouseover', function(e) {
        e.preventDefault();
        var elem = $(this);

        var vars = elem.attr('href').split('=');
        var url = 'ajax.php/tickets/'+vars[1]+'/preview';
        var id='t'+vars[1];
        var xoffset = 80;

        elem.data('timer', 0);
        if(!elem.data('id')) {
            elem.data('id', id);
            if(e.type=='mouseover') {
                 /* wait about 1 sec - before showing the tip - mouseout kills the timeout*/
                 elem.data('timer',setTimeout(function() { showtip(url,elem,xoffset);},750))
            }else{
                clearTimeout(elem.data('timer'));
                showtip(url,elem,xoffset);
            }
        }
    }).live('mouseout', function(e) {
        $(this).data('id', 0);
        clearTimeout($(this).data('timer'));
    });

    //User preview
    $('.userPreview').live('mouseover', function(e) {
        e.preventDefault();
        var elem = $(this);

        var vars = elem.attr('href').split('=');
        var url = 'ajax.php/users/'+vars[1]+'/preview';
        var id='u'+vars[1];
        var xoffset = 80;

        elem.data('timer', 0);
        if(!elem.data('id')) {
            elem.data('id', id);
            if(e.type=='mouseover') {
                 /* wait about 1 sec - before showing the tip - mouseout kills the timeout*/
                 elem.data('timer',setTimeout(function() { showtip(url,elem,xoffset);},750))
            }else{
                clearTimeout(elem.data('timer'));
                showtip(url, elem, xoffset);
            }
        }
    }).live('mouseout', function(e) {
        $(this).data('id', 0);
        clearTimeout($(this).data('timer'));
    });

    $('body')
    .delegate('.tip_close', 'click', function(e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    });

    $(document).live('mouseup', function (e) {
        var container = $('.tip_box');
        if (!container.is(e.target)
            && container.has(e.target).length === 0) {
            container.remove();
        }
    });
});

//code from wipage
/*
	for editing cells and add button
*/

	function init()
{
    var tables = document.getElementsByClassName("editabletable");
    var i;
    for (i = 0; i < tables.length; i++)
    {
        makeTableEditable(tables[i]);
    }
}

function makeTableEditable(table)
{
    var rows = table.rows;
    var r;
    for (r = 0; r < rows.length; r++)
    {
        var cols = rows[r].cells;
        var c;
        for (c = 0; c < cols.length; c++)
        {
            var cell = cols[c];
            var listener = makeEditListener(table, r, c);
            cell.addEventListener("input", listener, false);
        }
    }
}

function makeEditListener(table, row, col)
{
    return function(event)
    {
        var cell = getCellElement(table, row, col);
        var text = cell.innerHTML.replace(/<br>$/, '');
        var items = split(text);

        if (items.length === 1)
        {
            // Text is a single element, so do nothing.
            // Without this each keypress resets the focus.
            return;
        }

        var i;
        var r = row;
        var c = col;
        for (i = 0; i < items.length && r < table.rows.length; i++)
        {
            cell = getCellElement(table, r, c);
            cell.innerHTML = items[i]; // doesn't escape HTML

            c++;
            if (c === table.rows[r].cells.length)
            {
                r++;
                c = 0;
            }
        }
        cell.focus();
    };
}

function getCellElement(table, row, col)
{
    // assume each cell contains a div with the text
    return table.rows[row].cells[col].firstChild;
}

function split(str)
{
    // use comma and whitespace as delimiters
    return str.split(/,|\s|<br>/);
}

window.onload = init;

function displayResult()
{
	var table=document.getElementById("myTable");
	var row=table.insertRow(-1);
	var cell1=row.insertCell(0);
	var cell2=row.insertCell(0);
	var cell3=row.insertCell(0);
	var cell4=row.insertCell(0);
	var cell5=row.insertCell(0);
	cell1.style.textAlign="center";
	cell1.style.backgroundColor="#CCCCCC";
	cell2.style.textAlign="center";
	cell3.style.textAlign="left";
	cell4.style.textAlign="center";
	cell5.style.textAlign="center";
	
	
	
	cell1.innerHTML="<td><table width='100%'><tr><td align='left' width='1%'>$</td><td align='right' width='9%'>&nbsp</td></tr></table></td>";    
	
	cell2.innerHTML="<td><table width='100%'><tr><td align='left' width='1%'>$</td><td align='right' width='9%'><div contenteditable>&nbsp;</div></td></tr></table></td>";
	
	cell3.innerHTML="<td><div contenteditable>&nbsp;</div></td>";
	cell4.innerHTML="<td><div contenteditable>&nbsp;</div></td>";
	cell5.innerHTML="<td><div contenteditable>&nbsp;</div></td>";	
}

function updateTable(){
	var editable_table = document.getElementById("myTable");
	var fixed_table = document.getElementById("fixed_table");
	var final_table = document.getElementById("final_table");
	var rows = editable_table.rows;
	var qty;
	var unit_price;
	var total_price;
	var i;
	var value;
	for(i=1;i<rows.length;i++){
		value = '';
		qty = rows[i].cells[1].textContent;
		unit_price = rows[i].cells[3].getElementsByTagName('table')[0].rows[0].cells[1].textContent;
		total_price = rows[i].cells[4].getElementsByTagName('table')[0].rows[0].cells[1];
		//alert(qty);
		if(qty=='' && unit_price==''){
			value = '';
			total_price.innerHTML = '';
		}
		
		else if(qty=='' || unit_price=='' || isNaN(qty) || isNaN(unit_price)){
			rows[i].cells[4].innerHTML = 'invalid';
			alert("There is invalid data in row "+i+". The page will be reloaded.");
			window.location.reload();
			break;
		}
		
		else {
			value = qty*unit_price;
			total_price.innerHTML = parseFloat(value).toFixed(2);
		}
		
		
	}
	
	var sum = 0;
	
	if(final_table.rows[1].cells[1].getElementsByTagName('table')[0].rows[0].cells[1].textContent==0)final_table.rows[1].cells[1].getElementsByTagName('table')[0].rows[0].cells[1].innerHTML="<td><div contenteditable>0.00</div></td>";
	if(fixed_table.rows[0].cells[3].getElementsByTagName('table')[0].rows[0].cells[1].textContent==0)fixed_table.rows[0].cells[3].getElementsByTagName('table')[0].rows[0].cells[1].innerHTML="<td><div contenteditable>0.00</div></td>";
	if(fixed_table.rows[0].cells[1].textContent==0)fixed_table.rows[0].cells[1].innerHTML="<td><div contenteditable>0</div></td>";
	if(fixed_table.rows[1].cells[1].textContent==0)fixed_table.rows[1].cells[1].innerHTML="<td><div contenteditable>0</div></td>";
	if(fixed_table.rows[1].cells[3].getElementsByTagName('table')[0].rows[0].cells[1].textContent==0)fixed_table.rows[1].cells[3].getElementsByTagName('table')[0].rows[0].cells[1].innerHTML="<td><div contenteditable>0.00</div></td>";
	
	for(i=1;i<rows.length;i++){
		if(rows[i].cells[4].textContent!='invalid')sum = sum + parseFloat(rows[i].cells[4].getElementsByTagName('table')[0].rows[0].cells[1].textContent);
	}
		
	labour_charge = fixed_table.rows[0].cells[1].textContent * fixed_table.rows[0].cells[3].getElementsByTagName('table')[0].rows[0].cells[1].textContent;
	onsiteCallOutFee = fixed_table.rows[1].cells[1].textContent * fixed_table.rows[1].cells[3].getElementsByTagName('table')[0].rows[0].cells[1].textContent;
	
	if(isNaN(labour_charge)){
		alert("Invalid Labour Charge");
		window.location.reload();
	}
	if(isNaN(onsiteCallOutFee)){
		alert("Invalid Onsite Callout Fee.");
		window.location.reload();
	}
	
	fixed_table.rows[0].cells[4].getElementsByTagName('table')[0].rows[0].cells[1].innerHTML = parseFloat(labour_charge).toFixed(2);
	fixed_table.rows[1].cells[4].getElementsByTagName('table')[0].rows[0].cells[1].innerHTML = parseFloat(onsiteCallOutFee).toFixed(2);
	sum = sum + parseFloat(labour_charge) + parseFloat(onsiteCallOutFee);
	var total = final_table.rows[2].cells[1].getElementsByTagName('table')[0].rows[0].cells[1];
	total.innerHTML = parseFloat(sum).toFixed(2);
	
	
	
	var GST = final_table.rows[1].cells[1].getElementsByTagName('table')[0].rows[0].cells[1];
	
	GST.innerHTML = parseFloat(total.textContent/11).toFixed(2);
	
	sum = total.textContent - GST.textContent;	

	var Net = final_table.rows[0].cells[1].getElementsByTagName('table')[0].rows[0].cells[1];
	Net.innerHTML = parseFloat(sum).toFixed(2);
}

function createInput(){
		var editable_table = document.getElementById("myTable");
		var fixed_table = document.getElementById("fixed_table");
		var final_table = document.getElementById("final_table");
		var rows = editable_table.rows;
		var qty;
		var unit_price;
		var total_price;
		var i;
		var value;
		
		var data_row = 0;
		var oldstr,newstr;
		for(i=1;i<rows.length;i++){
			oldstr = rows[i].cells[0].textContent;
			newstr = oldstr.replace(/\s+/g,"");
			if(newstr=='');
			else data_row++;	
		}
		
		
		var form = document.getElementById('save');
		var codeinp,qtyinp,desinp,upinp,totinp;
		var j,atname;
		
		for(i=1,j=1;i<rows.length;i++){
			oldstr = rows[i].cells[0].textContent;
			newstr = oldstr.replace(/\s+/g,"");
			if(newstr=='');
			else{
				json = rows[i].cells[0].textContent;
				atname = "codeinp"+j;
				codeinp = document.createElement("input");
				codeinp.setAttribute("type","hidden");
				codeinp.setAttribute("name", atname);
				codeinp.setAttribute("value", json);
				form.appendChild(codeinp);
				
				json = rows[i].cells[1].textContent;
				atname = "qtyinp"+j;
				qtyinp = document.createElement("input");
				qtyinp.setAttribute("type","hidden");
				qtyinp.setAttribute("name", atname);
				qtyinp.setAttribute("value", json);
				form.appendChild(qtyinp);
				
				json = rows[i].cells[2].textContent;
				atname = "desinp"+j;
				desinp = document.createElement("input");
				desinp.setAttribute("type","hidden");
				desinp.setAttribute("name", atname);
				desinp.setAttribute("value", json);
				form.appendChild(desinp);
				
				json = rows[i].cells[3].getElementsByTagName('table')[0].rows[0].cells[1].textContent;
				atname = "upinp"+j;
				upinp = document.createElement("input");
				upinp.setAttribute("type","hidden");
				upinp.setAttribute("name", atname);
				upinp.setAttribute("value", json);
				form.appendChild(upinp);
				
				json = rows[i].cells[4].getElementsByTagName('table')[0].rows[0].cells[1].textContent;
				atname = "totinp"+j;
				totinp = document.createElement("input");
				totinp.setAttribute("type","hidden");
				totinp.setAttribute("name", atname);
				totinp.setAttribute("value", json);
				form.appendChild(totinp);	
				j++;
			}
		}
		
		var rowinp;
		json = data_row;
		atname = "data_row";
		rowinp = document.createElement("input");
		rowinp.setAttribute("type","hidden");
		rowinp.setAttribute("name", atname);
		rowinp.setAttribute("value", json);
		form.appendChild(rowinp);		
		
		var labqtyinp, labourinp, labourtotinp, onsiteqtyinp, onsiteinp, ontotinp, net_priceinp, gstinp, grand_totalinp;
		
		json = fixed_table.rows[0].cells[1].textContent;
		atname = "labourqty";
		labqtyinp = document.createElement("input");
		labqtyinp.setAttribute("type","hidden");
		labqtyinp.setAttribute("name", atname);
		labqtyinp.setAttribute("value", json);
		form.appendChild(labqtyinp);
		
		json = fixed_table.rows[0].cells[3].getElementsByTagName('table')[0].rows[0].cells[1].textContent;
		atname = "labour";
		labourinp = document.createElement("input");
		labourinp.setAttribute("type","hidden");
		labourinp.setAttribute("name", atname);
		labourinp.setAttribute("value", json);
		form.appendChild(labourinp);
		
		json = fixed_table.rows[0].cells[4].getElementsByTagName('table')[0].rows[0].cells[1].textContent;
		atname = "labourtot";
		labourtotinp = document.createElement("input");
		labourtotinp.setAttribute("type","hidden");
		labourtotinp.setAttribute("name", atname);
		labourtotinp.setAttribute("value", json);
		form.appendChild(labourtotinp);
		
		json = fixed_table.rows[1].cells[1].textContent;
		atname = "onsiteqty";
		onsiteqtyinp = document.createElement("input");
		onsiteqtyinp.setAttribute("type","hidden");
		onsiteqtyinp.setAttribute("name", atname);
		onsiteqtyinp.setAttribute("value", json);
		form.appendChild(onsiteqtyinp);
		
		json = fixed_table.rows[1].cells[3].getElementsByTagName('table')[0].rows[0].cells[1].textContent;
		atname = "onsitefee";
		onsiteinp = document.createElement("input");
		onsiteinp.setAttribute("type","hidden");
		onsiteinp.setAttribute("name", atname);
		onsiteinp.setAttribute("value", json);
		form.appendChild(onsiteinp);
		
		json = fixed_table.rows[1].cells[4].getElementsByTagName('table')[0].rows[0].cells[1].textContent;
		atname = "ontotal";
		ontotinp = document.createElement("input");
		ontotinp.setAttribute("type","hidden");
		ontotinp.setAttribute("name", atname);
		ontotinp.setAttribute("value", json);
		form.appendChild(ontotinp);
		
		json = final_table.rows[0].cells[1].getElementsByTagName('table')[0].rows[0].cells[1].textContent;
		atname = "net_price";
		net_priceinp = document.createElement("input");
		net_priceinp.setAttribute("type","hidden");
		net_priceinp.setAttribute("name", atname);
		net_priceinp.setAttribute("value", json);
		form.appendChild(net_priceinp);
		
		json = final_table.rows[1].cells[1].getElementsByTagName('table')[0].rows[0].cells[1].textContent;
		atname = "gst";
		gstinp = document.createElement("input");
		gstinp.setAttribute("type","hidden");
		gstinp.setAttribute("name", atname);
		gstinp.setAttribute("value", json);
		form.appendChild(gstinp);
		
		json = final_table.rows[2].cells[1].getElementsByTagName('table')[0].rows[0].cells[1].textContent;
		atname = "grand_total";
		grand_totalinp = document.createElement("input");
		grand_totalinp.setAttribute("type","hidden");
		grand_totalinp.setAttribute("name", atname);
		grand_totalinp.setAttribute("value", json);
		form.appendChild(grand_totalinp);		
		//form.submit();
	}

function reloadPage(){
	reload();
}

// ends wipage

// add hong
function displayLicense(type1, type2, type3, number1, number2, number3)
{
	var table=document.getElementById("myTable");

	var row=table.insertRow(-1);
	var cell4=row.insertCell(0);
	var cell3=row.insertCell(0);
	var cell2=row.insertCell(0);
	var cell1=row.insertCell(0);

	var cellStr1 = "<td><select style='width:100%;' name='slicense[type1][]'><option value=''>&lt;Select&gt;</option>" + 
				"<option value='eight_user'" + ((type1=="eight_user")? "selected='selected' ":"") + ">8 User Extension</option>" + 
				"<option value='sixt_user'" + ((type1=="sixt_user")?" selected='selected' ":"") + ">16 User Extension</option>" + 
				"<option value='thirtwo_user'" + ((type1=="thirtwo_user")?" selected='selected' ":"") + ">32 User Extension</option>" + 
				"<option value='sixtfour_user'" + ((type1=="sixtfour_user")?" selected='selected' ":"") + ">64 User Extension</option>" + 
				"<option value='barge_in'" + ((type1=="barge_in")?" selected='selected' ":"") + ">Barge In</option>" + 
				"<option value='call_rec'" + ((type1=="call_rec")?" selected='selected' ":"") + ">Call Recording</option>" + 
				 "<option value='conf_bridge'" + ((type1=="conf_bridge")?" selected='selected' ":"")+ ">Conference Bridge</option>" + 
				 "<option value='video_conf'" + ((type1=="video_conf")?" selected='selected' ":"") + ">Video Conference </option>" + 
				 "<option value='dcc'" + ((type1=="dcc")?" selected='selected' ":"") + ">DCC Support</option>" + 
				 "<option value='acd'" + ((type1=="acd")?" selected='selected' ":"") + ">ACD</option>" + 
			     "<option value='auto_dial'" + ((type1=="auto_dial")?" selected='selected' ":"") + ">Auto Dialler</option>" + 
			     "</select></td>";
	var cellStr2 = "<td><select style='width:100%;' name='slicense[type2][]'><option value=''>&lt;Select&gt;</option>" + 
				"<option value='eight_user'" + ((type2=="eight_user")? "selected='selected' ":"") + ">8 User Extension</option>" + 
				"<option value='sixt_user'" + ((type2=="sixt_user")?" selected='selected' ":"") + ">16 User Extension</option>" + 
				"<option value='thirtwo_user'" + ((type2=="thirtwo_user")?" selected='selected' ":"") + ">32 User Extension</option>" + 
				"<option value='sixtfour_user'" + ((type2=="sixtfour_user")?" selected='selected' ":"") + ">64 User Extension</option>" + 
				"<option value='barge_in'" + ((type2=="barge_in")?" selected='selected' ":"") + ">Barge In</option>" + 
				"<option value='call_rec'" + ((type2=="call_rec")?" selected='selected' ":"") + ">Call Recording</option>" + 
				 "<option value='conf_bridge'" + ((type2=="conf_bridge")?" selected='selected' ":"")+ ">Conference Bridge</option>" + 
				 "<option value='video_conf'" + ((type2=="video_conf")?" selected='selected' ":"") + ">Video Conference </option>" + 
				 "<option value='dcc'" + ((type2=="dcc")?" selected='selected' ":"") + ">DCC Support</option>" + 
				 "<option value='acd'" + ((type2=="acd")?" selected='selected' ":"") + ">ACD</option>" + 
			     "<option value='auto_dial'" + ((type2=="auto_dial")?" selected='selected' ":"") + ">Auto Dialler</option>" + 
			     "</select></td>";
     var cellStr3 = "<td><select style='width:100%;' name='slicense[type3][]'><option value=''>&lt;Select&gt;</option>" + 
					"<option value='eight_user'" + ((type3=="eight_user")? "selected='selected' ":"") + ">8 User Extension</option>" + 
					"<option value='sixt_user'" + ((type3=="sixt_user")?" selected='selected' ":"") + ">16 User Extension</option>" + 
					"<option value='thirtwo_user'" + ((type3=="thirtwo_user")?" selected='selected' ":"") + ">32 User Extension</option>" + 
					"<option value='sixtfour_user'" + ((type3=="sixtfour_user")?" selected='selected' ":"") + ">64 User Extension</option>" + 
					"<option value='barge_in'" + ((type3=="barge_in")?" selected='selected' ":"") + ">Barge In</option>" + 
					"<option value='call_rec'" + ((type3=="call_rec")?" selected='selected' ":"") + ">Call Recording</option>" + 
					 "<option value='conf_bridge'" + ((type3=="conf_bridge")?" selected='selected' ":"")+ ">Conference Bridge</option>" + 
					 "<option value='video_conf'" + ((type3=="video_conf")?" selected='selected' ":"") + ">Video Conference </option>" + 
					 "<option value='dcc'" + ((type3=="dcc")?" selected='selected' ":"") + ">DCC Support</option>" + 
					 "<option value='acd'" + ((type3=="acd")?" selected='selected' ":"") + ">ACD</option>" + 
				     "<option value='auto_dial'" + ((type3=="auto_dial")?" selected='selected' ":"") + ">Auto Dialler</option>" + 
				     "</select></td>";

	cell1.innerHTML="<td><b>License Type</b></td>";
	cell2.innerHTML=cellStr1;
	cell3.innerHTML=cellStr2;
	cell4.innerHTML=cellStr3;

	var row=table.insertRow(-1);
	var cell4=row.insertCell(0);
	var cell3=row.insertCell(0);
	var cell2=row.insertCell(0);
	var cell1=row.insertCell(0);

	cell1.innerHTML="<td><b>License Number</b></td>";
	cell2.innerHTML= "<td><input type='text'  style='width:98%;' value='" + number1 + "' name='slicense[num1][]'/></td>";
	cell3.innerHTML= "<td><input type='text'  style='width:98%;' value='" + number2 + "' name='slicense[num2][]'/></td>";
	cell4.innerHTML= "<td><input type='text'  style='width:98%;' value='" + number3 + "' name='slicense[num3][]'/></td>";
	
}

function addLicense()
{
	var table=document.getElementById("myTable");

	var row=table.insertRow(-1);
	var cell4=row.insertCell(0);
	var cell3=row.insertCell(0);
	var cell2=row.insertCell(0);
	var cell1=row.insertCell(0);

	var cellStrOption = 
		"<option value='eight_user'>8 User Extension</option>" + 
		"<option value='sixt_user'>16 User Extension</option>" + 
		"<option value='thirtwo_user'>32 User Extension</option>" + 
		"<option value='sixtfour_user'>64 User Extension</option>" + 
		"<option value='barge_in'>Barge In</option>" + 
		"<option value='call_rec'>Call Recording</option>" + 
		 "<option value='conf_bridge'>Conference Bridge</option>" + 
		 "<option value='video_conf'>Video Conference </option>" + 
		 "<option value='dcc'>DCC Support</option>" + 
		 "<option value='acd'>ACD</option>" + 
	     "<option value='auto_dial'>Auto Dialler</option>" + 
	     "</select></td>";

	cell1.innerHTML="<td><b>License Type</b></td>";
	cell2.innerHTML="<td><select style='width:100%;' name='slicense[type1][]'><option value=''>&lt;Select&gt;</option>" + cellStrOption;
	cell3.innerHTML="<td><select style='width:100%;' name='slicense[type2][]'><option value=''>&lt;Select&gt;</option>" + cellStrOption;
	cell4.innerHTML="<td><select style='width:100%;' name='slicense[type3][]'><option value=''>&lt;Select&gt;</option>" + cellStrOption;

	var row=table.insertRow(-1);
	var cell4=row.insertCell(0);
	var cell3=row.insertCell(0);
	var cell2=row.insertCell(0);
	var cell1=row.insertCell(0);

	cell1.innerHTML="<td><b>License Number</b></td>";
	cell2.innerHTML= "<td><input type='text' style='width:98%;' name='slicense[num1][]'/></td>";
	cell3.innerHTML= "<td><input type='text' style='width:98%;' name='slicense[num2][]'/></td>";
	cell4.innerHTML= "<td><input type='text' style='width:98%;' name='slicense[num3][]'/></td>";
	
}

function displayHardware(type1, type2, type3, model1, model2, model3, qty1, qty2, qty3)
{
	var table=document.getElementById("myTable2");

	var row=table.insertRow(-1);
	var cell4=row.insertCell(0);
	var cell3=row.insertCell(0);
	var cell2=row.insertCell(0);
	var cell1=row.insertCell(0);

	var cellStr1 = "<td><select style='width:100%;' name='hwd[type1][]'><option value=''>&lt;Select&gt;</option>" + 
				"<option value='poe_s_five'" + ((type1=="poe_s_five")? "selected='selected' ":"") + ">PoE Switch - 5 Port</option>" + 
				"<option value='poe_s_eight'" + ((type1=="poe_s_eight")? "selected='selected' ":"") + ">PoE Switch - 8 Port</option>" + 
				"<option value='poe_s_sixt'" + ((type1=="poe_s_sixt")? "selected='selected' ":"") + ">PoE Switch - 16 Port</option>" + 
				"<option value='poe_s_twfour'" + ((type1=="poe_s_twfour")? "selected='selected' ":"") + ">PoE Switch - 24 Port</option>" + 
				"<option value='poe_s_foteight'" + ((type1=="poe_s_foteight")? "selected='selected' ":"") + ">PoE Switch - 48 Port</option>" + 
				"<option value='ups'" + ((type1=="ups")? "selected='selected' ":"") + ">UPS</option>" + 
				"<option value='router'" + ((type1=="router")? "selected='selected' ":"") + ">Router</option>" + 
				"<option value='modem'" + ((type1=="modem")? "selected='selected' ":"") + ">Modem</option>" + 
				"<option value='sip_hand'" + ((type1=="sip_hand")? "selected='selected' ":"") + ">SIP Handset</option>" + 
				"<option value='sip_sidecar'" + ((type1=="sip_sidecar")? "selected='selected' ":"") + ">SIP Sidecar Console</option>" + 
				"<option value='sip_confphone'" + ((type1=="sip_confphone")? "selected='selected' ":"") + ">SIP Conference Phone</option>" + 
				"<option value='sip_cordlessphone'" + ((type1=="sip_cordlessphone")? "selected='selected' ":"") + ">SIP Cordless Phone</option>" + 
				"<option value='corded_haed'" + ((type1=="corded_haed")? "selected='selected' ":"") + ">Corded Headset</option>" + 
				"<option value='cordless_head'" + ((type1=="cordless_head")? "selected='selected' ":"") + ">Cordless Headset</option>" + 
				"<option value='other'" + ((type1=="other")? "selected='selected' ":"") + ">&lt;Other&gt;</option>" + 
				"</select></td>";
	var cellStr2 = "<td><select style='width:100%;' name='hwd[type2][]'><option value=''>&lt;Select&gt;</option>" + 
				"<option value='poe_s_five'" + ((type2=="poe_s_five")? "selected='selected' ":"") + ">PoE Switch - 5 Port</option>" + 
				"<option value='poe_s_eight'" + ((type2=="poe_s_eight")? "selected='selected' ":"") + ">PoE Switch - 8 Port</option>" + 
				"<option value='poe_s_sixt'" + ((type2=="poe_s_sixt")? "selected='selected' ":"") + ">PoE Switch - 16 Port</option>" + 
				"<option value='poe_s_twfour'" + ((type2=="poe_s_twfour")? "selected='selected' ":"") + ">PoE Switch - 24 Port</option>" + 
				"<option value='poe_s_foteight'" + ((type2=="poe_s_foteight")? "selected='selected' ":"") + ">PoE Switch - 48 Port</option>" + 
				"<option value='ups'" + ((type2=="ups")? "selected='selected' ":"") + ">UPS</option>" + 
				"<option value='router'" + ((type2=="router")? "selected='selected' ":"") + ">Router</option>" + 
				"<option value='modem'" + ((type2=="modem")? "selected='selected' ":"") + ">Modem</option>" + 
				"<option value='sip_hand'" + ((type2=="sip_hand")? "selected='selected' ":"") + ">SIP Handset</option>" + 
				"<option value='sip_sidecar'" + ((type2=="sip_sidecar")? "selected='selected' ":"") + ">SIP Sidecar Console</option>" + 
				"<option value='sip_confphone'" + ((type2=="sip_confphone")? "selected='selected' ":"") + ">SIP Conference Phone</option>" + 
				"<option value='sip_cordlessphone'" + ((type2=="sip_cordlessphone")? "selected='selected' ":"") + ">SIP Cordless Phone</option>" + 
				"<option value='corded_haed'" + ((type2=="corded_haed")? "selected='selected' ":"") + ">Corded Headset</option>" + 
				"<option value='cordless_head'" + ((type2=="cordless_head")? "selected='selected' ":"") + ">Cordless Headset</option>" + 
				"<option value='other'" + ((type2=="other")? "selected='selected' ":"") + ">&lt;Other&gt;</option>" + 
			     "</select></td>";
     var cellStr3 = "<td><select style='width:100%;' name='hwd[type3][]'><option value=''>&lt;Select&gt;</option>" + 
		     	"<option value='poe_s_five'" + ((type3=="poe_s_five")? "selected='selected' ":"") + ">PoE Switch - 5 Port</option>" + 
				"<option value='poe_s_eight'" + ((type3=="poe_s_eight")? "selected='selected' ":"") + ">PoE Switch - 8 Port</option>" + 
				"<option value='poe_s_sixt'" + ((type3=="poe_s_sixt")? "selected='selected' ":"") + ">PoE Switch - 16 Port</option>" + 
				"<option value='poe_s_twfour'" + ((type3=="poe_s_twfour")? "selected='selected' ":"") + ">PoE Switch - 24 Port</option>" + 
				"<option value='poe_s_foteight'" + ((type3=="poe_s_foteight")? "selected='selected' ":"") + ">PoE Switch - 48 Port</option>" + 
				"<option value='ups'" + ((type3=="ups")? "selected='selected' ":"") + ">UPS</option>" + 
				"<option value='router'" + ((type3=="router")? "selected='selected' ":"") + ">Router</option>" + 
				"<option value='modem'" + ((type3=="modem")? "selected='selected' ":"") + ">Modem</option>" + 
				"<option value='sip_hand'" + ((type3=="sip_hand")? "selected='selected' ":"") + ">SIP Handset</option>" + 
				"<option value='sip_sidecar'" + ((type3=="sip_sidecar")? "selected='selected' ":"") + ">SIP Sidecar Console</option>" + 
				"<option value='sip_confphone'" + ((type3=="sip_confphone")? "selected='selected' ":"") + ">SIP Conference Phone</option>" + 
				"<option value='sip_cordlessphone'" + ((type3=="sip_cordlessphone")? "selected='selected' ":"") + ">SIP Cordless Phone</option>" + 
				"<option value='corded_haed'" + ((type3=="corded_haed")? "selected='selected' ":"") + ">Corded Headset</option>" + 
				"<option value='cordless_head'" + ((type3=="cordless_head")? "selected='selected' ":"") + ">Cordless Headset</option>" + 
				"<option value='other'" + ((type3=="other")? "selected='selected' ":"") + ">&lt;Other&gt;</option>" + 
				"</select></td>";

	cell1.innerHTML="<td><b>Harware Type</b></td>";
	cell2.innerHTML=cellStr1;
	cell3.innerHTML=cellStr2;
	cell4.innerHTML=cellStr3;

	var row=table.insertRow(-1);
	var cell4=row.insertCell(0);
	var cell3=row.insertCell(0);
	var cell2=row.insertCell(0);
	var cell1=row.insertCell(0);

	cell1.innerHTML="<td><b>Model</b></td>";
	cell2.innerHTML= "<td><input type='text'  style='width:98%;' value='" + model1 + "' name='hwd[model1][]'/></td>";
	cell3.innerHTML= "<td><input type='text'  style='width:98%;' value='" + model2 + "' name='hwd[model2][]'/></td>";
	cell4.innerHTML= "<td><input type='text'  style='width:98%;' value='" + model3 + "' name='hwd[model3][]'/></td>";
	
	var row=table.insertRow(-1);
	var cell4=row.insertCell(0);
	var cell3=row.insertCell(0);
	var cell2=row.insertCell(0);
	var cell1=row.insertCell(0);

	cell1.innerHTML="<td><b>Quantity</b></td>";
	cell2.innerHTML= "<td><input type='text'  size='7' value='" + qty1 + "' name='hwd[qty1][]'/></td>";
	cell3.innerHTML= "<td><input type='text'  size='7' value='" + qty2 + "' name='hwd[qty2][]'/></td>";
	cell4.innerHTML= "<td><input type='text'  size='7' value='" + qty3 + "' name='hwd[qty3][]'/></td>";
	
}

function addHardware()
{
	var table=document.getElementById("myTable2");

	var row=table.insertRow(-1);
	var cell4=row.insertCell(0);
	var cell3=row.insertCell(0);
	var cell2=row.insertCell(0);
	var cell1=row.insertCell(0);

	var cellStrOption = 
		"<option value='poe_s_five'>PoE Switch - 5 Port</option>" + 
		"<option value='poe_s_eight'>PoE Switch - 8 Port</option>" + 
		"<option value='poe_s_sixt'>PoE Switch - 16 Port</option>" + 
		"<option value='poe_s_twfour'>PoE Switch - 24 Port</option>" + 
		"<option value='poe_s_foteight'>PoE Switch - 48 Port</option>" + 
		"<option value='ups'>UPS</option>" + 
		"<option value='router'>Router</option>" + 
		"<option value='modem'>Modem</option>" + 
		"<option value='sip_hand'>SIP Handset</option>" + 
		"<option value='sip_sidecar'>SIP Sidecar Console</option>" + 
		"<option value='sip_confphone'>SIP Conference Phone</option>" + 
		"<option value='sip_cordlessphone'>SIP Cordless Phone</option>" + 
		"<option value='corded_haed'>Corded Headset</option>" + 
		"<option value='cordless_head'>Cordless Headset</option>" + 
		"<option value='other'>&lt;Other&gt;</option>" + 
	     "</select></td>";

	cell1.innerHTML="<td><b>Hardware Type</b></td>";
	cell2.innerHTML="<td><select style='width:100%;' name='hwd[type1][]'><option value=''>&lt;Select&gt;</option>" + cellStrOption;
	cell3.innerHTML="<td><select style='width:100%;' name='hwd[type2][]'><option value=''>&lt;Select&gt;</option>" + cellStrOption;
	cell4.innerHTML="<td><select style='width:100%;' name='hwd[type3][]'><option value=''>&lt;Select&gt;</option>" + cellStrOption;

	var row=table.insertRow(-1);
	var cell4=row.insertCell(0);
	var cell3=row.insertCell(0);
	var cell2=row.insertCell(0);
	var cell1=row.insertCell(0);

	cell1.innerHTML="<td><b>Model</b></td>";
	cell2.innerHTML= "<td><input type='text' style='width:98%;' name='hwd[model1][]'/></td>";
	cell3.innerHTML= "<td><input type='text' style='width:98%;' name='hwd[model2][]'/></td>";
	cell4.innerHTML= "<td><input type='text' style='width:98%;' name='hwd[model3][]'/></td>";
	
	var row=table.insertRow(-1);
	var cell4=row.insertCell(0);
	var cell3=row.insertCell(0);
	var cell2=row.insertCell(0);
	var cell1=row.insertCell(0);

	cell1.innerHTML="<td><b>Quantity</b></td>";
	cell2.innerHTML= "<td><input type='text' size='7' name='hwd[qty1][]'/></td>";
	cell3.innerHTML= "<td><input type='text' size='7' name='hwd[qty2][]'/></td>";
	cell4.innerHTML= "<td><input type='text' size='7' name='hwd[qty3][]'/></td>";
	
}

function displayHardwareWifi(ssidname, ssidpwd, svcname, peip, svcother, peipuser, devtype, peippwd, 
		                     devtypeother, devbrand, authip, devmodel, authuser, devserial, authpwd)
{
	var table=document.getElementById("myTable3");
	
	var row=table.insertRow(-1);
	row.innerHTML="<th align='left' ><b>Wireless Details</b></th><th></th><th></th><th></th>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td><span style='color:black;'>SSID Name : </span></td><td><input type='text' size='40' value='" + ssidname + "' name='hwdwifi[ssidname][]'></td><td></td><td></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td><span style='color:black;'>SSID Password : </span></td><td><input type='text' size='40' value='" + ssidpwd + "' name='hwdwifi[ssidpwd][]'></td><td></td><td></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td colspan='2'><b>Wireless Access Point (AP)</b></td><td colspan='2'><b>Device Access Details</b></td>";
	
	var row=table.insertRow(-1);
	var selSvcStrOption = 
		"<option value='wifi_office'" + ((svcname=="wifi_office")? "selected='selected' ":"") + ">Office Wi-Fi</option>" + 
		"<option value='wifi_public'" + ((svcname=="wifi_public")? "selected='selected' ":"") + ">Public Wi-Fi</option>" + 
		"<option value='wifi_private'" + ((svcname=="wifi_private")? "selected='selected' ":"") + ">Private Wi-Fi</option>" + 
		"<option value='wifi_shared'" + ((svcname=="wifi_shared")? "selected='selected' ":"") + ">Shared Wi-Fi</option>" + 
		"<option value='wifi_customer'" + ((svcname=="wifi_customer")? "selected='selected' ":"") + ">Customer Wi-Fi</option>" + 
		"<option value='other'>&lt;Other&gt;</option>" + 
	     "</select></td>";
	row.innerHTML="<td><span style='color:black;'>Service Name : </span></td>" + 
	               "<td><select name='hwdwifi[svcname][]' style='width:70%;' ><option value=''>&lt;Select&gt;</option>" + selSvcStrOption +
	               "<td><span style='color:black;'>PE IP Address :</span></td><td><input name='hwdwifi[peip][]' value='" + peip + "'  type='text' style='width:70%;' ></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td><span style='color:black;'>Other : </span></td><td><input name='hwdwifi[svcother][]'  value='" + svcother + "' type='text' style='width:70%;' ></td>" + 
	              "<td><span style='color:black;'>User Name :</span></td><td><input name='hwdwifi[peipuser][]' value='" + peipuser + "' type='text' style='width:70%;' ></td>";
	
	var row=table.insertRow(-1);
	var selDevStrOption = 
		"<option value='dev_ap'" + ((devtype=="dev_ap")? "selected='selected' ":"") + ">AP Device</option>" + 
		"<option value='dev_wifimodem'" + ((devtype=="dev_wifimodem")? "selected='selected' ":"") + ">Wi-Fi Modem</option>" + 
		"<option value='dev_wifirouter'" + ((devtype=="dev_wifirouter")? "selected='selected' ":"") + ">Wi-Fi Router</option>" + 
		"<option value='dev_wifiippbx'" + ((devtype=="dev_wifiippbx")? "selected='selected' ":"") + ">Wi-Fi IPPBX</option>" + 
		"<option value='other'>&lt;Other&gt;</option>" + 
	    "</select></td>";
	row.innerHTML="<td><span style='color:black;'>Device Type : </span></td>" + 
	               "<td><select name='hwdwifi[devtype][]' style='width:70%;' ><option value=''>&lt;Select&gt;</option>" + selDevStrOption +
	               "<td><span style='color:black;'>Password :</span></td><td><input name='hwdwifi[peippwd][]' value='" + peippwd + "' type='text' style='width:70%;' ></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td><span style='color:black;'>Other : </span></td><td><input name='hwdwifi[devtypeother][]' value='" + devtypeother + "' type='text' style='width:70%;' ></td>" + 
	              " <td colspan='2'>Authentication Details</td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td><span style='color:black;'>Brand : </span></td><td><input name='hwdwifi[devbrand][]' value='" + devbrand + "' type='text' style='width:70%;' ></td>" + 
	              "<td><span style='color:black;'>IP Address :</span></td><td><input name='hwdwifi[authip][]' value='" + authip + "' type='text' style='width:70%;' ></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td><span style='color:black;'>Model : </span></td><td><input name='hwdwifi[devmodel][]' value='" + devmodel + "' type='text' style='width:70%;' ></td>" + 
	              "<td><span style='color:black;'>User Name :</span></td><td><input name='hwdwifi[authuser][]' value='" + authuser + "' type='text' style='width:70%;' ></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td><span style='color:black;'>Serial Number : </span></td><td><input name='hwdwifi[devserial][]' value='" + devserial + "' type='text' style='width:70%;' ></td>" + 
	              "<td><span style='color:black;'>Password :</span></td><td><input name='hwdwifi[authpwd][]' value='" + authpwd + "' type='text' style='width:70%;' ></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML= "<td colspan='4'><hr/></td>";
}

function addHardwareWifi()
{
	var table=document.getElementById("myTable3");

	var row=table.insertRow(-1);
	row.innerHTML="<th align='left' ><b>Wireless Details</b></th><th></th><th></th><th></th>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td><span style='color:black;'>SSID Name : </span></td><td><input type='text' size='40' name='hwdwifi[ssidname][]'></td><td></td><td></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td><span style='color:black;'>SSID Password : </span></td><td><input type='text' size='40' name='hwdwifi[ssidpwd][]'></td><td></td><td></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td colspan='2'><b>Wireless Access Point (AP)</b></td><td colspan='2'><b>Device Access Details</b></td>";
	
	var row=table.insertRow(-1);
	var selSvcStrOption = 
		"<option value='wifi_office'>Office Wi-Fi</option>" + 
		"<option value='wifi_public'>Public Wi-Fi</option>" + 
		"<option value='wifi_private'>Private Wi-Fi</option>" + 
		"<option value='wifi_shared'>Shared Wi-Fi</option>" + 
		"<option value='wifi_customer'>Customer Wi-Fi</option>" + 
		"<option value='other'>&lt;Other&gt;</option>" + 
	     "</select></td>";
	row.innerHTML="<td><span style='color:black;'>Service Name : </span></td>" + 
	               "<td><select name='hwdwifi[svcname][]' style='width:70%;' ><option value=''>&lt;Select&gt;</option>" + selSvcStrOption +
	               "<td><span style='color:black;'>PE IP Address :</span></td><td><input name='hwdwifi[peip][]' type='text' style='width:70%;' ></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td><span style='color:black;'>Other : </span></td><td><input name='hwdwifi[svcother][]' type='text' style='width:70%;' ></td>" + 
	              "<td><span style='color:black;'>User Name :</span></td><td><input name='hwdwifi[peipuser][]' type='text' style='width:70%;' ></td>";
	
	var row=table.insertRow(-1);
	var selDevStrOption = 
		"<option value='dev_ap'>AP Device</option>" + 
		"<option value='dev_wifimodem'>Wi-Fi Modem</option>" + 
		"<option value='dev_wifirouter'>Wi-Fi Router</option>" + 
		"<option value='dev_wifiippbx'>Wi-Fi IPPBX</option>" + 
		"<option value='other'>&lt;Other&gt;</option>" + 
	    "</select></td>";
	row.innerHTML="<td><span style='color:black;'>Device Type : </span></td>" + 
	               "<td><select name='hwdwifi[devtype][]' style='width:70%;' ><option value=''>&lt;Select&gt;</option>" + selDevStrOption +
	               "<td><span style='color:black;'>Password :</span></td><td><input name='hwdwifi[peippwd][]' type='text' style='width:70%;' ></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td><span style='color:black;'>Other : </span></td><td><input name='hwdwifi[devtypeother][]' type='text' style='width:70%;' ></td>" + 
	              " <td colspan='2'>Authentication Details</td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td><span style='color:black;'>Brand : </span></td><td><input name='hwdwifi[devbrand][]' type='text' style='width:70%;' ></td>" + 
	              "<td><span style='color:black;'>IP Address :</span></td><td><input name='hwdwifi[authip][]' type='text' style='width:70%;' ></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td><span style='color:black;'>Model : </span></td><td><input name='hwdwifi[devmodel][]' type='text' style='width:70%;' ></td>" + 
	              "<td><span style='color:black;'>User Name :</span></td><td><input name='hwdwifi[authuser][]' type='text' style='width:70%;' ></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td><span style='color:black;'>Serial Number : </span></td><td><input name='hwdwifi[devserial][]' type='text' style='width:70%;' ></td>" + 
	              "<td><span style='color:black;'>Password :</span></td><td><input name='hwdwifi[authpwd][]' type='text' style='width:70%;' ></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML= "<td colspan='4'><hr/></td>";
	
}

function displayContacts(person, position, department, phone, mobile, email)
{
	var table=document.getElementById("myTable4");
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>&nbsp;&nbsp;&nbsp;&nbsp;Contact Person :</td><td><input type='text' size='50' value='" + person + "' name='cont[person][]' style='width:92%;'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>&nbsp;&nbsp;&nbsp;&nbsp;Position :</td><td><input type='text' size='20'  value='" + position + "' name='cont[position][]'>&nbsp;&nbsp;Department :  <input type='text' size='20'  value='"+ department + "' name='cont[department][]' style='width:33%;'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>&nbsp;&nbsp;&nbsp;&nbsp;Phone Number :</td><td><input type='text' size='20'  value='" + phone + "' name='cont[phone][]'>&nbsp;&nbsp;Mobile :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' size='20'  value='"+mobile+"' name='cont[mobile][]' style='width:33%;'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160' style='border-bottom:2px solid #0094B3;'>&nbsp;&nbsp;&nbsp;&nbsp;Email Address :</td><td style='border-bottom:2px solid #0094B3;'><input type='text' size='50'  value='"+ email + "' name='cont[email][]' style='width:92%;'></td>";
}

function addContact()
{
	var table=document.getElementById("myTable4");
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>&nbsp;&nbsp;&nbsp;&nbsp;Contact Person :</td><td><input type='text' size='50' name='cont[person][]' style='width:92%;'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>&nbsp;&nbsp;&nbsp;&nbsp;Position :</td><td><input type='text' size='20' name='cont[position][]'>&nbsp;&nbsp;Department :  <input type='text' size='20' name='cont[department][]' style='width:33%;'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>&nbsp;&nbsp;&nbsp;&nbsp;Phone Number :</td><td><input type='text' size='20' name='cont[phone][]'>&nbsp;&nbsp;Mobile :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' size='20' name='cont[mobile][]' style='width:33%;'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'style='border-bottom:2px solid #0094B3;'>&nbsp;&nbsp;&nbsp;&nbsp;Email Address :</td><td style='border-bottom:2px solid #0094B3;'><input type='text' size='50' name='cont[email][]' style='width:92%;'></td>";

}

function displayHardwarePC(devtype, other, owner, location, userName, pwd, ipaddr, hosting, port)
{
	var table=document.getElementById("myTable5");
	
	var row=table.insertRow(-1);
	var selDevStrOption = 
		"<option value='dev_server'" + ((devtype=="dev_server")? "selected='selected' ":"") + ">Server</option>" + 
		"<option value='dev_workstation'" + ((devtype=="dev_workstation")? "selected='selected' ":"") + ">Workstation</option>" + 
		"<option value='dev_notebook'" + ((devtype=="dev_notebook")? "selected='selected' ":"") + ">Notebook</option>" + 
		"<option value='other'>&lt;Other&gt;</option>" + 
	    "</select></td>";
	row.innerHTML="<td>Type of Device : </td>" + 
	    "<td><select name='hwdpc[devtype][]' style='width:120px;' ><option value=''>&lt;Select&gt;</option>" + selDevStrOption;
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>Other :</td><td><input type='text' size='50'  value='" + other + "' name='hwdpc[other][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>Device Owner :</td><td><input type='text' size='50'  value='" + owner + "' name='hwdpc[owner][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>Device Location :</td><td><input type='text' size='50'  value='" + location + "' name='hwdpc[location][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>User Name :</td><td><input type='text' size='50'  value='" + userName + "' name='hwdpc[user][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>Password :</td><td><input type='text' size='50'  value='" + pwd + "' name='hwdpc[pwd][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>IP Address :</td><td><input type='text' size='50'  value='" + ipaddr + "' name='hwdpc[ipaddr][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>Hosting :</td><td><input type='text' size='50'  value='" + hosting + "' name='hwdpc[hosting][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>Port Number :</td><td><input type='text' size='50'  value='" + port + "' name='hwdpc[port][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML= "<td colspan='2'><hr/></td>";
	
}

function addHardwarePC()
{
var table=document.getElementById("myTable5");
	
	var row=table.insertRow(-1);
	var selDevStrOption = 
		"<option value='dev_server'>Server</option>" + 
		"<option value='dev_workstation'>Workstation</option>" + 
		"<option value='dev_notebook'>Notebook</option>" + 
		"<option value='other'>&lt;Other&gt;</option>" + 
	    "</select></td>";
	
	row.innerHTML="<td>Type of Device : </td>" + 
	    "<td><select name='hwdpc[devtype][]' style='width:120px;' ><option value=''>&lt;Select&gt;</option>" + selDevStrOption;
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>Other :</td><td><input type='text' size='50'  value='' name='hwdpc[other][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>Device Owner :</td><td><input type='text' size='50'  value='' name='hwdpc[owner][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>Device Location :</td><td><input type='text' size='50'  value='' name='hwdpc[location][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>User Name :</td><td><input type='text' size='50'  value='' name='hwdpc[user][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>Password :</td><td><input type='text' size='50'  value='' name='hwdpc[pwd][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>IP Address :</td><td><input type='text' size='50'  value='' name='hwdpc[ipaddr][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>Hosting :</td><td><input type='text' size='50'  value='' name='hwdpc[hosting][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>Port Number :</td><td><input type='text' size='50'  value='' name='hwdpc[port][]'></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML= "<td colspan='2'><hr/></td>";

}

function displayNotes(notes)
{
	
	var table=document.getElementById("myTable6");
	
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>Notes :</td><td><textarea name='notes[contents][]' style='width:95%' rows='5'>" + notes + "</textarea></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML= "<td colspan='2'><hr/></td>";
	
}

function addNotes()
{
	var table=document.getElementById("myTable6");
		
	var row=table.insertRow(-1);
	row.innerHTML="<td width='160'>Notes :</td><td><textarea name='notes[contents][]' style='width:95%' rows='5'></textarea></td>";
	
	var row=table.insertRow(-1);
	row.innerHTML= "<td colspan='2'><hr/></td>";

}
// end add hong