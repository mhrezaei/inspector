// base url find for use in ajax
//function base_url(ext)
//{
//    var url     = window.location.href,
//        base    = url.substring(0, url.indexOf('/', 14)),
//        //ret_url = base + "/inspector/";
//        ret_url = base + "/";
//
//    if(ext !== undefined && ext !== '') {
//        ret_url += ext;
//    }
//
//    return ret_url;
//}

// national code verify
function nationalCodeVerify(code)
{
  
  if(code.length == 10 && !isNaN(code))
    {
        var code = code.split("");
        var err ;
        for(var i = 0; i < code.length; i++)
        {
            if(code[0] > code[i] || code[0] < code[i])
            {
                err = 1;
                break;
            }
            else
            {
                err = 2;
            }
        }
        
        if(err == 1)
        {
            var valid = 0;
            var jumper = 10;
            for(var i = 0; i <= 8; i++)
            {
                valid += code[i] * jumper;
                --jumper;
            }
            valid = valid % 11;
            if(valid >= 0 && valid < 2)
            {
                if(valid == code['9'])
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                valid = 11 - valid;
                if(valid == code['9'])
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}

// load state from data base and insert in select input
function insertState(el, sel)
{
    var j = 1;
    if(j > 0)
    {
        $.ajax({
        type: "POST",
        url: base_url() + "ajax/ajax_conf/load_states",
        cache: false,
        data: {stateID: NaN, isSelected: sel}
        }).done(function(Data){
            $('#' + el).html(Data);
        });
        j--;
    }
}

// load city from database with state id and insert in select input
function insertcity(el, sta, sel)
{
    if(sta > 0)
    {
        var st = sta;
    }
    else
    {
        var st = $('#' + sta).val();
    }
    if(st > 0)
    {
        var j = 1;
        if(j > 0)
        {
            $.ajax({
            type: "POST",
            url: base_url() + "ajax/ajax_conf/load_states",
            cache: false,
            data: {stateID: st, isSelected: sel}
            }).done(function(Data){
                $('#' + el).html(Data);
                $('#' + el).removeAttr('disabled', 'disabled');
            });
            j--;
        }
    }
    else
    {
        $('#' + el).html('<option value="0">انتخاب کنید...</option>');
        $('#' + el).attr('disabled', 'disabled');
    }
}

// load opu from database and insert in select input
function insertOpu(el, sel)
{
    var j = 1;
    if(j > 0)
    {
        $.ajax({
        type: "POST",
        url: base_url() + "ajax/ajax_conf/load_opu",
        cache: false,
        data: {isSelected: sel}
        }).done(function(Data){
            $('#' + el).html(Data);
            $('#' + el).removeAttr('disabled', 'disabled');
        });
        j--;
    }
}

// load hospitals from database with opu id
function insertHospital(el, sta, sel, searchBy)
{
    if(sta > 0)
    {
        var st = sta;
    }
    else
    {
        var st = $('#' + sta).val();
    }
    if(st > 0)
    {
        var j = 1;
        if(j > 0)
        {
            $.ajax({
            type: "POST",
            url: base_url() + "ajax/ajax_conf/load_hospital",
            cache: false,
            data: {stateID: st, isSelected: sel, where: searchBy}
            }).done(function(Data){
                $('#' + el).html(Data);
                $('#' + el).removeAttr('disabled', 'disabled');
            });
            j--;
        }
    }
    else
    {
        $('#' + el).html('<option value="0">انتخاب کنید...</option>');
        $('#' + el).attr('disabled', 'disabled');
    }
}

// load inspectors from database with opu id
function insertInspectors(el, sta, sel)
{
    if(sta > 0)
    {
        var st = sta;
    }
    else
    {
        var st = $('#' + sta).val();
    }
    if(st > 0)
    {
        var j = 1;
        if(j > 0)
        {
            $.ajax({
            type: "POST",
            url: base_url() + "ajax/ajax_conf/load_inspectors",
            cache: false,
            data: {opuID: st, isSelected: sel}
            }).done(function(Data){
                $('#' + el).html(Data);
                $('#' + el).removeAttr('disabled', 'disabled');
            });
            j--;
        }
    }
    else
    {
        $('#' + el).html('<option value="0">انتخاب کنید...</option>');
        $('#' + el).attr('disabled', 'disabled');
    }
}

// load doc from database and insert into select
function insertDoc(el, sel)
{
    var j = 1;
    if(j > 0)
    {
        $.ajax({
        type: "POST",
        url: base_url() + "ajax/ajax_conf/load_doc",
        cache: false,
        data: {stateID: NaN, isSelected: sel}
        }).done(function(Data){
            $('#' + el).html(Data);
            $('#' + el).removeAttr('disabled', 'disabled');
        });
        j--;
    }
}

// load doc option from database with tol id
function insertDocOption(el, sta, sel, type)
{
    if(sta > 0 || sta == '-1')
    {
        var st = sta;
    }
    else
    {
        var st = $('#' + sta).val();
    }
    if(st > 0 || sta == '-1')
    {
        var j = 1;
        if(j > 0)
        {
            $.ajax({
            type: "POST",
            url: base_url() + "ajax/ajax_conf/load_tol_option",
            cache: false,
            data: {stateID: st, isSelected: sel, searchType: type}
            }).done(function(Data){
                $('#' + el).html(Data);
                $('#' + el).removeAttr('disabled', 'disabled');
            });
            j--;
        }
    }
    else
    {
        $('#' + el).html('<option value="0">انتخاب کنید...</option>');
        $('#' + el).attr('disabled', 'disabled');
    }
}

// add a new opu to database
function registerNewOPU()
{
    var opu = $('#inputOpuName').val();
    var head = $('#inputHeadOffice').val();
    var mobile = $('#inputMobile').val();
    var telephone = $('#inputTelephone').val();
    var user = $('#inputUserName').val();
    var pass = $('#inputPassword').val();
    var state = $('#cbState').val();
    var city = $('#cbCity').val();
    var cbType = $('#cbType').val();
    //var cbGrade = $('#cbGrade').val();
    var cbGrade = 1;
    var inputPopulation = $('#inputPopulation').val();
    var inputPmp = $('#inputPmp').val();
    $('#successAlert1').hide();
    $('#dangerAlert1').hide();
    $('#dangerAlert2').hide();
    $('#dangerAlert3').hide();
    $('#dangerAlert4').hide();
    $('#addOpuModalLoading').hide();
    if(opu.length > 5 && head.length > 5 && mobile.length == 11 && telephone.length == 11 && user.length > 2 &&
        pass.length > 5 && state > 0 && city > 0 && cbType != 0 && cbGrade > 0 && inputPopulation.length > 0 && inputPmp.length > 0)
    {
        $('#saveBTN').attr('disabled', 'disabled');
        $('#addOpuModalLoading').show();
        var j = 1;
        if(j > 0)
        {
            $.ajax({
            type: "POST",
            url: base_url() + "ajax/ajax_conf/insert_opu",
            cache: false,
            data: {
                opuName: opu,
                headOffice: head,
                mob: mobile,
                tel: telephone,
                username: user,
                password: pass,
                stateId: state,
                cityId: city,
                cbType: cbType,
                cbGrade: cbGrade,
                population: inputPopulation,
                pmp: inputPmp
            }
            }).done(function(Data){
                $('#saveBTN').removeAttr('disabled', 'disabled');
                $('#addOpuModalLoading').hide();
                if(Data == 1)
                {
                    $('#successAlert1').show();
                    setTimeout(function(){
                       window.location.reload(1);
                    }, 5000);
                }
                else if(Data == 2)
                {
                    $('#dangerAlert1').show();
                }
                else if(Data == 3)
                {
                    $('#dangerAlert2').show();
                }
                else if(Data == 4)
                {
                    $('#dangerAlert3').show();
                }
                else if(Data == 5)
                {
                    $('#dangerAlert4').show();
                }
            });
            j--;
        }
    }
    else
    {
        $('#dangerAlert3').show();
        $('#addOpuModal').modal('handleUpdate');
    }
}

// edit a opu from database
function editOPU(id)
{
    $('#editOpuForm').hide();
    $('#OpuEditModalLoading').show();
    $('#saveBTNEdit').attr('disabled', 'disabled');
    $('#successAlertEdit1').hide();
    $('#dangerAlertEdit1').hide();
    $('#dangerAlertEdit2').hide();
    $('#dangerAlertEdit3').hide();
    $('#dangerAlertEdit4').hide();
    $('#warningAlert1').hide();
    
    $('#inputEditOpuName').val('');
    $('#inputEditHeadOffice').val('');
    $('#inputEditMobile').val('');
    $('#inputEditTelephone').val('');
    $('#inputEditUserName').val('');
    $('#cbEditState').html('');
    $('#cbEditState').html('');
    if(id > 0)
    {
        var j = 1;
        if(j > 0)
        {
            $.ajax({
            dataType: "json",
            type: "POST",
            url: base_url() + "ajax/ajax_conf/select_one_opu",
            cache: false,
            data: {opuID: id}
            }).done(function(Data){
                // result
                insertState('cbEditState', Data.state);
                insertcity('cbEditCity', Data.state, Data.city);
                $('#inputEditOpuName').val(Data.name);
                $('#inputEditHeadOffice').val(Data.headOffice);
                $('#inputEditMobile').val(Data.mobile);
                $('#inputEditTelephone').val(Data.telephone);
                $('#inputEditUserName').val(Data.username);
                $('#cbEditCity').val(Data.city);
                $('#cbEditType').val(Data.type);
                $('#cbEditGrade').val(Data.grade);
                $('#inputEditPopulation').val(Data.population);
                $('#inputEditPmp').val(Data.pmp);
                $('#OpuEditModalLoading').hide();
                $('#editOpuForm').show();
                $('#saveBTNEdit').removeAttr('disabled', 'disabled');
                $('#warningAlert1').show();
                $('#editOpuModal').modal('handleUpdate');
            }).fail(function(){
                $('#dangerAlertEdit1').show();
                $('#OpuEditModalLoading').hide();
            });
            j--;
        }
        $('#saveBTNEdit').unbind('click').bind('click', function(){
            $('#successAlertEdit1').hide();
            $('#dangerAlertEdit1').hide();
            $('#dangerAlertEdit2').hide();
            $('#dangerAlertEdit3').hide();
            $('#dangerAlertEdit4').hide();
            $('#warningAlert1').hide();

            var opu = $('#inputEditOpuName').val();
            var head = $('#inputEditHeadOffice').val();
            var mobile = $('#inputEditMobile').val();
            var telephone = $('#inputEditTelephone').val();
            var pass = $('#inputEditPassword').val();
            var state = $('#cbEditState').val();
            var city = $('#cbEditCity').val();
            var type = $('#cbEditType').val();
            //var grade = $('#cbEditGrade').val();
            var grade = 1;
            var pmp = $('#inputEditPmp').val();
            var population = $('#inputEditPopulation').val();
            $('#warningAlert1').hide();
            if(opu.length > 5 && head.length > 5 && mobile.length == 11 && telephone.length == 11 && state > 0 && city > 0 &&
            type != 0 && grade > 0 && pmp.length > 0 && population.length > 0)
            {
                if(pass.length > 0 && pass.length > 5)
                {
                    pass = pass;
                }
                else
                {
                    pass = 'notAffected';
                }
                $('#saveBTNEdit').attr('disabled', 'disabled');
                $('#OpuEditModalLoading').show();
                var l = 1;
                if(l > 0)
                {
                    $.ajax({
                    type: "POST",
                    url: base_url() + "ajax/ajax_conf/edit_one_opu",
                    cache: false,
                    data: {
                        opuName: opu,
                        headOffice: head,
                        mob: mobile,
                        tel: telephone,
                        password: pass,
                        stateId: state,
                        cityId: city,
                        opuId: id,
                        cbType: type,
                        cbGrade: grade,
                        population: population,
                        pmp: pmp
                    }
                    }).done(function(Data){
                        $('#saveBTNEdit').removeAttr('disabled', 'disabled');
                        $('#OpuEditModalLoading').hide();
                        if(Data == 1)
                        {
                            $('#successAlertEdit1').show();
                            setTimeout(function(){
                               window.location.reload(1);
                            }, 5000);
                        }
                        else if(Data == 2)
                        {
                            $('#dangerAlertEdit2').show();
                        }
                        else if(Data == 3)
                        {
                            $('#dangerAlertEdit1').show();
                        }
                        else if(Data == 4)
                        {
                            $('#dangerAlertEdit3').show();
                        }
                        else if(Data == 5)
                        {
                            $('#dangerAlertEdit4').show();
                        }
                    });
                    l--;
                }
            }
            else
            {
                $('#dangerAlertEdit3').show();
            }
        });
    }
}

// add new hospital
function addNewHospital()
{
    insertState('cbAddState', false);
    insertOpu('cbAddOpu', false);
    insertcity('cbAddCity', -1, false);
    $('#addHospitalModalLoading').hide();
    $('#successAlert1').hide();
    $('#dangerAlert1').hide();
    $('#dangerAlert3').hide();
    $('#dangerAlert4').hide();

    $('#cbAddIcu').on('change', function(){
        if($('#cbAddIcu').val() == 2 || $('#cbAddIcu').val() == 0)
        {
            $("#inputIcuBed").attr('disabled', 'disabled');
            $("#inputIcuBedBusy").attr('disabled', 'disabled');
            $("#inputIcuDeathPerYear").attr('disabled', 'disabled');
        }
        else
        {
            $("#inputIcuBed").removeAttr('disabled', 'disabled');
            $("#inputIcuBedBusy").removeAttr('disabled', 'disabled');
            $("#inputIcuDeathPerYear").removeAttr('disabled', 'disabled');
        }
    });

    $('#saveBTN').removeAttr('disabled', 'disabled').unbind('click').bind('click', function(){
        $('#successAlert1').hide();
        $('#dangerAlert1').hide();
        $('#dangerAlert3').hide();
        $('#dangerAlert4').hide();

        var opu = $('#cbAddOpu').val();
        var name = $('#inputHopitalName').val();
        var state = $('#cbAddState').val();
        var city = $('#cbAddCity').val();
        var cbAddType = $('#cbAddType').val();
        var cbAddIcu = $('#cbAddIcu').val();
        var inputIcuBed = $('#inputIcuBed').val();
        var inputIcuBedBusy = $('#inputIcuBedBusy').val();
        var cbAddNeuro = $('#cbAddNeuro').val();
        var inputDeathPerYear = $('#inputDeathPerYear').val();
        var inputIcuDeathPerYear = $('#inputIcuDeathPerYear').val();
        if(cbAddIcu > 0 && cbAddIcu == 1)
        {
            if(inputIcuBed > 0 && inputIcuBedBusy > 0 && inputIcuDeathPerYear > 0)
            {
                var insertData = 1;
            }
            else
            {
                var insertData = 0;
            }

        }
        else
        {
            var insertData = 1;
        }
        if(name.length > 1 && opu > 0 && state > 0 && city > 0 && cbAddType > 0 && cbAddIcu > 0 && cbAddNeuro > 0 && inputDeathPerYear > 0 && insertData == 1)
        {
            $('#saveBTN').attr('disabled', 'disabled');
            $('#addHospitalModalLoading').show();
            var j = 1;
            if(j > 0)
            {
                $.ajax({
                type: "POST",
                url: base_url() + "ajax/ajax_conf/add_new_hospital",
                cache: false,
                data: {
                    hrName: name,
                    opuId: opu,
                    stateId: state,
                    cityId: city,
                    cbType: cbAddType,
                    cbIcu: cbAddIcu,
                    icuBed: inputIcuBed,
                    icuBedBusy: inputIcuBedBusy,
                    cbNeuro: cbAddNeuro,
                    deathPerYear: inputDeathPerYear,
                    deathIcuPerYear: inputIcuDeathPerYear,
                    year: $("#inputYear").val()
                }
                }).done(function(Data){
                    $('#saveBTN').removeAttr('disabled', 'disabled');
                    $('#addHospitalModalLoading').hide();
                    if(Data == 1)
                    {
                        $('#successAlert1').show();
                        setTimeout(function(){
                           window.location.reload(1);
                        }, 1000);
                    }
                    else if(Data == 2)
                    {
                        $('#dangerAlert1').show();
                    }
                    else if(Data == 3)
                    {
                        $('#dangerAlert3').show();
                    }
                    else if(Data == 4)
                    {
                        $('#dangerAlert4').show();
                    }
                });
                j--;
            }
        }
        else
        {
            $('#dangerAlert3').show();
        }
        $('#addHospitalModal').modal('handleUpdate');
    });
}

// edit a hospital from database
function editHospital(id)
{
    $('#editHospitalForm').hide();
    document.editHospitalForm.reset();
    $('#editHospitalModalLoading').show();
    $('#saveBTNEdit').attr('disabled', 'disabled');
    $('#inputIcuBedEdit').removeAttr('disabled', 'disabled');
    $('#inputIcuBedBusyEdit').removeAttr('disabled', 'disabled');
    $('#inputIcuDeathPerYearEdit').removeAttr('disabled', 'disabled');
    $('#successAlertEdit1').hide();
    $('#dangerAlertEdit1').hide();
    $('#dangerAlertEdit2').hide();
    $('#dangerAlertEdit4').hide();
    $('#dangerAlertEdit3').hide();
    $('#warningAlert1').hide();
    
    $('#inputHopitalNameEdit').val('');
    $('#cbAddOpuEdit').html('<option value="0">انتخاب کنید...</option>');
    $('#cbAddStateEdit').html('<option value="0">انتخاب کنید...</option>');
    $('#cbAddCityEdit').html('<option value="0">انتخاب کنید...</option>');

    $('#cbAddIcuEdit').on('change', function(){
        if($('#cbAddIcuEdit').val() == 2 || $('#cbAddIcuEdit').val() == 0)
        {
            $("#inputIcuBedEdit").attr('disabled', 'disabled').val('0');
            $("#inputIcuBedBusyEdit").attr('disabled', 'disabled').val('0');
            $("#inputIcuDeathPerYearEdit").attr('disabled', 'disabled').val('0');
        }
        else
        {
            $("#inputIcuBedEdit").removeAttr('disabled', 'disabled');
            $("#inputIcuBedBusyEdit").removeAttr('disabled', 'disabled');
            $("#inputIcuDeathPerYearEdit").removeAttr('disabled', 'disabled');
        }
    });

    if(id > 0)
    {
        var j = 1;
        if(j > 0)
        {
            $.ajax({
            dataType: "json",
            type: "POST",
            url: base_url() + "ajax/ajax_conf/select_one_hospital",
            cache: false,
            data: {hosID: id}
            }).done(function(Data){
                // result
                insertState('cbAddStateEdit', Data.state);
                insertcity('cbAddCityEdit', Data.state, Data.city);
                insertOpu('cbAddOpuEdit', Data.opuId);
                $('#inputHopitalNameEdit').val(Data.name);
                $('#inputIcuBedEdit').val(Data.icuBeds);
                $('#inputIcuBedBusyEdit').val(Data.icuBedsBusy);

                if(Data.type > 0)
                {
                    $('#cbAddTypeEdit').val(Data.type);
                }
                else
                {
                    $('#cbAddTypeEdit').val(0);
                }

                if(Data.icu > 0)
                {
                    $('#cbAddIcuEdit').val(Data.icu);
                }
                else
                {
                    $('#cbAddIcuEdit').val(0);
                }

                if(Data.neuroService)
                {
                    $('#cbAddNeuroEdit').val(Data.neuroService);
                }
                else
                {
                    $('#cbAddNeuroEdit').val(0);
                }

                if(Data.haveData == 1)
                {
                    $('#inputDeathPerYearEdit').val(Data.data[0].deathPerYear);
                    $('#inputIcuDeathPerYearEdit').val(Data.data[0].icuDeathPerYear);
                }


                $('#editHospitalModalLoading').hide();
                $('#editHospitalForm').show();
                $('#saveBTNEdit').removeAttr('disabled', 'disabled');
                $('#warningAlert1').show();
            }).fail(function(){
                $('#dangerAlertEdit1').show();
                $('#editHospitalModalLoading').hide();
            });
            j--;
        }
        $('#saveBTNEdit').unbind('click').bind('click', function(){
            var name = $('#inputHopitalNameEdit').val();
            var opu = $('#cbAddOpuEdit').val();
            var state = $('#cbAddStateEdit').val();
            var city = $('#cbAddCityEdit').val();
            var cbAddType = $('#cbAddTypeEdit').val();
            var cbAddIcu = $('#cbAddIcuEdit').val();
            var inputIcuBed = $('#inputIcuBedEdit').val();
            var inputIcuBedBusy = $('#inputIcuBedBusyEdit').val();
            var cbAddNeuro = $('#cbAddNeuroEdit').val();
            var inputDeathPerYear = $('#inputDeathPerYearEdit').val();
            var inputIcuDeathPerYear = $('#inputIcuDeathPerYearEdit').val();
            if(cbAddIcu > 0 && cbAddIcu == 1)
            {
                if(inputIcuBed > 0 && inputIcuBedBusy > 0 && inputIcuDeathPerYear > 0)
                {
                    var insertData = 1;
                }
                else
                {
                    var insertData = 0;
                }

            }
            else
            {
                var insertData = 1;
            }
            $('#warningAlert1').hide();
            if(name.length > 1 && opu > 0 && state > 0 && city > 0 && cbAddType > 0 && cbAddIcu > 0 && cbAddNeuro > 0 && inputDeathPerYear > 0 && insertData == 1)
            {
                $('#successAlertEdit1').hide();
                $('#dangerAlertEdit1').hide();
                $('#dangerAlertEdit2').hide();
                $('#dangerAlertEdit4').hide();
                $('#dangerAlertEdit3').hide();
                $('#warningAlert1').hide();
                $('#saveBTNEdit').attr('disabled', 'disabled');
                $('#editHospitalModalLoading').show();
                var l = 1;
                if(l > 0)
                {
                    $.ajax({
                    type: "POST",
                    url: base_url() + "ajax/ajax_conf/edit_one_hospital",
                    cache: false,
                    data: {
                        hrName: name,
                        opuId: opu,
                        stateId: state,
                        cityId: city,
                        cbType: cbAddType,
                        cbIcu: cbAddIcu,
                        icuBed: inputIcuBed,
                        icuBedBusy: inputIcuBedBusy,
                        cbNeuro: cbAddNeuro,
                        deathPerYear: inputDeathPerYear,
                        deathIcuPerYear: inputIcuDeathPerYear,
                        hosId: id
                    }
                    }).done(function(Data){
                        $('#saveBTNEdit').removeAttr('disabled', 'disabled');
                        $('#editHospitalModalLoading').hide();
                        if(Data == 1)
                        {
                            $('#successAlertEdit1').show();
                            setTimeout(function(){
                               window.location.reload(1);
                            }, 5000);
                        }
                        else if(Data == 2)
                        {
                            $('#dangerAlertEdit2').show();
                        }
                        else if(Data == 3)
                        {
                            $('#dangerAlertEdit1').show();
                        }
                        else if(Data == 4)
                        {
                            $('#dangerAlertEdit3').show();
                        }
                        else if(Data == 5)
                        {
                            $('#dangerAlertEdit4').show();
                        }
                    });
                    l--;
                }
            }
            else
            {
                $('#editHospitalModalLoading').hide();
                $('#dangerAlertEdit3').show();
            }
        });
    }
}

// add new inspector
function addNewInspector()
{
    insertOpu('cbInpectorOpu', false);
    $('#addInspectorModalLoading').hide();
    $('#successAlert1').hide();
    $('#dangerAlert1').hide();
    $('#dangerAlert3').hide();
    $('#dangerAlert4').hide();
    $('#saveBTN').removeAttr('disabled', 'disabled');
    $('#saveBTN').unbind('click').bind('click', function(){
        var opu = $('#cbInpectorOpu').val();
        var name = $('#inputInspectorName').val();
        var nationalCode = $('#inputInspectorNationalCode').val();
        var mobile = $('#inputInspectorMobile').val();
        var password = $('#inputInspectorPassword').val();
        var type1 = $('#chInspectorType1').is(':checked');
        var type2 = $('#chInspectorType2').is(':checked');
        if(name.length > 5 && opu > 0 && nationalCode.length == 10 && mobile.length == 11 && password.length > 5 && (type1 || type2) && nationalCodeVerify(nationalCode))
        {
            if(type1 && type2)
            {
                inspectorType = 3;
            }
            else if(type1)
            {
                inspectorType = 1;
            }
            else if(type2)
            {
                inspectorType = 2;
            }
            $('#saveBTN').attr('disabled', 'disabled');
            $('#addHospitalModalLoading').show();
            $('#dangerAlert3').hide();
            var j = 1;
            if(j > 0)
            {
                $.ajax({
                type: "POST",
                url: base_url() + "ajax/ajax_conf/add_new_inspector",
                cache: false,
                data: {insName: name, opuId: opu, insNationalCode: nationalCode, insMobile: mobile, insPassword: password, insType: inspectorType}
                }).done(function(Data){
                    $('#saveBTN').removeAttr('disabled', 'disabled');
                    $('#addInspectorModalLoading').hide();
                    if(Data == 1)
                    {
                        $('#successAlert1').show();
                        setTimeout(function(){
                           window.location.reload(1);
                        }, 5000);
                    }
                    else if(Data == 2)
                    {
                        $('#dangerAlert1').show();
                    }
                    else if(Data == 3)
                    {
                        $('#dangerAlert3').show();
                    }
                    else if(Data == 4)
                    {
                        $('#dangerAlert4').show();
                    }
                });
                j--;
            }
        }
        else
        {
            $('#dangerAlert3').show();
        }
    });
}

// edit a inspector from database
function editInspector(id)
{
    $('#editInspectorModalForm').hide();
    $('#editInspectorModalLoading').show();
    $('#saveBTNEdit').attr('disabled', 'disabled');
    $('#successAlertEdit1').hide();
    $('#dangerAlertEdit1').hide();
    $('#dangerAlertEdit2').hide();
    $('#dangerAlertEdit4').hide();
    $('#dangerAlertEdit3').hide();
    
    $('#inputEditInspectorName').val('');
    $('#inputEditInspectorNationalCode').val('');
    $('#inputEditInspectorMobile').val('');
    $('#inputEditInspectorPassword').val('');
    $("#chEditInspectorType1").attr("checked", false);
    $("#chEditInspectorType2").attr("checked", false);
    $('#cbEditInpectorOpu').html('<option value="0">انتخاب کنید...</option>');
    if(id > 0)
    {
        var j = 1;
        if(j > 0)
        {
            $.ajax({
            dataType: "json",
            type: "POST",
            url: base_url() + "ajax/ajax_conf/select_one_inspector",
            cache: false,
            data: {insID: id}
            }).done(function(Data){
                // result
                insertOpu('cbEditInpectorOpu', Data.opuId);
                $('#inputEditInspectorName').val(Data.name);
                $('#inputEditInspectorNationalCode').val(Data.nationalCode);
                $('#inputEditInspectorMobile').val(Data.mobile);
                if(Data.type == 1)
                {
                    $("#chEditInspectorType1").click();
                }
                else if(Data.type == 2)
                {
                    $("#chEditInspectorType2").click();
                }
                else if(Data.type == 3)
                {
                    $("#chEditInspectorType1").click();
                    $("#chEditInspectorType2").click();
                }
                $('#editInspectorModalLoading').hide();
                $('#editInspectorModalForm').show();
                $('#saveBTNEdit').removeAttr('disabled', 'disabled');
            }).fail(function(){
                $('#dangerAlertEdit1').show();
                $('#editInspectorModalLoading').hide();
            });
            j--;
        }
        $('#saveBTNEdit').unbind('click').bind('click', function(){
            var opu = $('#cbInpectorOpuEdit').val();
            var name = $('#inputEditInspectorName').val();
            var nationalCode = $('#inputEditInspectorNationalCode').val();
            var mobile = $('#inputEditInspectorMobile').val();
            var password = $('#inputEditInspectorPassword').val();
            var type1 = $('#chEditInspectorType1').is(':checked');
            var type2 = $('#chEditInspectorType2').is(':checked');
        if(name.length > 5 && opu > 0 && nationalCode.length == 10 && mobile.length == 11 && (type1 || type2) && nationalCodeVerify(nationalCode))
        {
            if(type1 && type2)
            {
                inspectorType = 3;
            }
            else if(type1)
            {
                inspectorType = 1;
            }
            else if(type2)
            {
                inspectorType = 2;
            }
            if(password.length > 5)
            {
                password = password;
            }
            else
            {
                password = 'passwordNotAffected';
            }
            $('#saveBTNEdit').attr('disabled', 'disabled');
            $('#editInspectorModalLoading').show();
            $('#dangerAlertEdit3').hide();
            $('#dangerAlertEdit2').hide();
                var l = 1;
                if(l > 0)
                {
                    $.ajax({
                    type: "POST",
                    url: base_url() + "ajax/ajax_conf/edit_one_inspector",
                    cache: false,
                    data: {insName: name, opuId: opu, insNationalCode: nationalCode, insMobile: mobile, insPassword: password, insType: inspectorType, insID: id}
                    }).done(function(Data){
                        $('#saveBTNEdit').removeAttr('disabled', 'disabled');
                        $('#editInspectorModalLoading').hide();
                        if(Data == 1)
                        {
                            $('#successAlertEdit1').show();
                            setTimeout(function(){
                               window.location.reload(1);
                            }, 5000);
                        }
                        else if(Data == 2)
                        {
                            $('#dangerAlertEdit2').show();
                        }
                        else if(Data == 3)
                        {
                            $('#dangerAlertEdit1').show();
                        }
                        else if(Data == 4)
                        {
                            $('#dangerAlertEdit3').show();
                        }
                        else if(Data == 5)
                        {
                            $('#dangerAlertEdit4').show();
                        }
                    });
                    l--;
                }
            }
            else
            {
                $('#editInspectorModalLoading').hide();
                $('#dangerAlertEdit3').show();
            }
        });
    }
}

// if select other in doc load detail
function changeDoc()
{
    var d = $('#cbDoc').val();
    if(d == 8)
    {
        $('#inputDocDetail').show();
    }
    else
    {
        $('#inputDocDetail').hide();
    }
}

// if select other in patient detail load detail
function changePatientStatus()
{
    var d = $('#cbPatientStatus').val();
    if(d == 22)
    {
        $('#inputPatientStatusDetail').show();
    }
    else
    {
        $('#inputPatientStatusDetail').hide();
    }
}

// add new patient
function addPatient()
{
    insertDoc('cbDoc', false);
    $('#cbDoc').on('change', function(){
        changeDoc();
    });
    insertOpu('cbOpu', false);
    $('#cbOpu').on('change', function(){
        insertHospital('cbHospitals', 'cbOpu', false, 'opuId');
    });
    $('#cbTol').on('change', function(){
        insertDocOption('cbPatientStatus', 'cbTol', false, false);
        if($('#cbTol').val() == 1)
        {
            $('#cbBreathing').val('N');
            $('#cbCornea').val('N');
            $('#cbFaceMove').val('N');
            $('#cbBodyMove').val('N');
            $('#cbDoll').val('N');
            $('#cbGag').val('N');
            $('#cbCough').val('N');
            $('#cbPupil').val('N');
            //$('#GCS3Patients').show();
            //$('#firstSedationQ').hide();
        }
        else
        {
            $('#cbBreathing').val('U');
            $('#cbCornea').val('U');
            $('#cbFaceMove').val('U');
            $('#cbBodyMove').val('U');
            $('#cbDoll').val('U');
            $('#cbGag').val('U');
            $('#cbCough').val('U');
            $('#cbPupil').val('U');
            //$('#GCS3Patients').hide();
            //$('#firstSedationQ').show();
        }
    });

    // disable BUN or Urea
    $('#inputBUN').on('blur', function(){
        if($('#inputBUN').val() >= 0 && $('#inputBUN').val() <= 200 && $('#inputBUN').val().length > 0)
        {
            $('#inputUrea').attr('disabled', 'disabled').val('');
        }
        else
        {
            $('#inputUrea').removeAttr('disabled', 'disabled').val('');
        }
    });
    $('#inputUrea').on('blur', function(){
        if($('#inputUrea').val() >= 0 && $('#inputUrea').val() <= 500 && $('#inputUrea').val().length > 0)
        {
            $('#inputBUN').attr('disabled', 'disabled').val('');
        }
        else
        {
            $('#inputBUN').removeAttr('disabled', 'disabled').val('');
        }
    });
    // disable BUN or Urea

    $('#chisUnknown').on('change', function(){
        if($('#chisUnknown').is(':checked'))
        {
            $('#inputFullName').attr('disabled', 'disabled');
            $('#inputNationalCode').attr('disabled', 'disabled');
            $('#inputAge').attr('disabled', 'disabled');
        }
        else
        {
            $('#inputFullName').removeAttr('disabled', 'disabled');
            $('#inputNationalCode').removeAttr('disabled', 'disabled');
            $('#inputAge').removeAttr('disabled', 'disabled');
        }
    });

    $('#inputFullName').on('blur', function(){
        var ptName = $('#inputFullName').val();
        $('#warningAlertName').hide();
        $.ajax({
            dataType: "json",
            type: "POST",
                url: base_url() + "ajax/ajax_conf/found_patient_result",
                cache: false,
                data: {pName: ptName}
                }).done(function(Data){
                    if(Data.num_rows > 0)
                    {
                        var url = base_url() + Data.url + '/manage_patient?inputPatientFilter=' + ptName + '&searchTools=true';
                        $('#warningAlertName').html(Data.num_rows + ' عدد بیمار با نام وارد شده یافت شد، برای مشاهده بیماران ' + '<a target="_blank" href="' + url + '">اینجا</a>' + ' کلیک نمائید.');
                        $('#warningAlertName').show();
                    }
                    else
                    {
                        $('#warningAlertName').hide();
                    }
                });
    });
    $('#cbPatientStatus').on('change', function(){
        changePatientStatus();
    });

    $('#saveBTN').unbind('click').bind('click', function(){
        $('#dangerAlert').hide();
        $('#dangerAlert2').hide();
        var chisUnknown = $('#chisUnknown').is(':checked'); /////// is checked
        var inputFileNumber = $('#inputFileNumber').val();
        var inputFullName = $('#inputFullName').val();
        var inputNationalCode = $('#inputNationalCode').val();
        var inputAge = $('#inputAge').val();
        var cbBodyType = $('#cbBodyType').val();
        var cbDoc = $('#cbDoc').val();
        var inputDocDetail = $('#inputDocDetail').val(); // check shavad
        var inputFirstGCS = $('#inputFirstGCS').val();
        var cbOpu = $('#cbOpu').val();
        var cbPresentioan = $('#cbPresentioan').val();
        var cbHospitals = $('#cbHospitals').val();
        var cbSection = $('#cbSection').val();
        var inputTypeOfSection = $('#inputTypeOfSection').val();
        var cbBreathing = $('#cbBreathing').val();
        var inputBreathingDetail = $('#inputBreathingDetail').val();
        var cbSedation = $('#cbSedation').is(':checked'); /////// is checked
        var cbBodyMove = $('#cbBodyMove').val();
        var inputBodyMovementDetail = $('#inputBodyMovementDetail').val();
        var cbFaceMove = $('#cbFaceMove').val();
        var inputFaceMovementDetail = $('#inputFaceMovementDetail').val();
        var cbGag = $('#cbGag').val();
        var cbCough = $('#cbCough').val();
        var cbCornea = $('#cbCornea').val();
        var cbPupil = $('#cbPupil').val();
        var cbTol = $('#cbTol').val();
        var cbMin = $('#cbMin').val();
        var cbHour = $('#cbHour').val();
        var cbPatientStatus = $('#cbPatientStatus').val();
        var inputT = $('#inputT').val();
        var inputPR = $('#inputPR').val();
        var inputFIO2 = $('#inputFIO2').val();
        var inputOut = $('#inputOut').val();
        var inputBPb = $('#inputBPb').val();
        var inputBPp = $('#inputBPp').val();
        var inputRR = $('#inputRR').val();
        var inputO2SAT = $('#inputO2SAT').val();
        var cbSedation2 = $('#cbSedation2').val();
        var inputNa = $('#inputNa').val();
        var inputK = $('#inputK').val();
        var inputBUN = $('#inputBUN').val();
        var inputUrea = $('#inputUrea').val();
        var inputCr = $('#inputCr').val();
        var inputCa = $('#inputCa').val();
        var inputALT = $('#inputALT').val();
        var inputAST = $('#inputAST').val();
        var inputHb = $('#inputHb').val();
        var inputWBC = $('#inputWBC').val();
        var inputPLT = $('#inputPLT').val();
        var inputBs = $('#inputBs').val();

        var tests = 0;
        if(inputT >= 20 && inputT <= 50 &&
        inputRR >= 0 && inputRR <= 100 &&
        inputPR >= 0 && inputPR <= 200 &&
        inputFIO2 >= 0 && inputFIO2 <= 100 &&
        inputOut >= 0 && inputOut <= 3000 &&
        inputBPb >= 0 && inputBPb <= 300 &&
        inputBPp >= 0 && inputBPp <= 200 &&
        inputO2SAT >= 0 && inputO2SAT <= 100 &&
        inputNa >= 0 && inputNa <= 300 &&
        inputK >= 0 && inputK <= 20 &&
            ((inputBUN >= 0 && inputBUN <= 200) || (inputUrea >= 0 && inputUrea <= 500)) &&
        inputALT >= 0 && inputALT <= 2000 &&
        inputAST >= 0 && inputAST <= 2000 &&
        inputHb >= 0 && inputHb <= 30 &&
        inputWBC >= 0 && inputWBC <= 100000 &&
        inputPLT >= 1000 && inputPLT <= 999000 &&
        inputBs >= 0 && inputBs <= 1000 &&
        inputCr >= 0 && inputCr <= 20 &&
        inputCa >= 0 && inputCa <= 20)
        {
            tests = 1;
        }
        else
        {
            tests = 0;
        }

        var haveTests = 0;
        if(inputT.length > 0 || inputRR.length > 0 || inputPR.length > 0 || inputFIO2.length > 0 || inputOut.length > 0 ||
        inputBPb.length > 0 || inputBPp.length > 0 || inputO2SAT.length > 0 || inputNa.length > 0 || inputK.length > 0 ||
        inputALT.length > 0 || inputAST.length > 0 || inputHb.length > 0 || inputWBC.length > 0 || inputPLT.length > 0 ||
        inputBs.length > 0 || inputCr.length > 0 || inputCa.length > 0 || inputBUN.length > 0 || inputUrea.length > 0)
        {
            haveTests = 1;
        }
        else
        {
            haveTests = 0;
        }


        if($('#rdAddDate1').is(':checked'))
        {
            var rdDate = 'toDay';
        }
        else if($('#rdAddDate2').is(':checked'))
        {
            var rdDate = 'lastDay';
        }
        else
        {
            var rdDate = false;
        }


        if(inputFileNumber.length > 0 && cbDoc > 0 && inputFirstGCS >= 3 && inputFirstGCS <= 15 && cbOpu > 0 && cbPresentioan > 0 && cbHospitals > 0 && cbSection > 0 && cbTol > 0 && cbPatientStatus > 0 && cbMin != 'min' && cbHour != 'hour')
        {
            if($('#cbTol').val() == 4 || $('#cbTol').val() == 1 || $('#cbTol').val() == 2)
            {
                if(tests && haveTests)
                {
                    if(chisUnknown)
                    {
                        var cont = 1;
                    }
                    else
                    {
                        if(inputFullName.length > 5 && inputAge > 0)
                        {
                            var cont = 1;
                        }
                        else
                        {
                            var cont = 2;
                        }
                    }
                }
                else
                {
                    var cont = 3;
                }
            }
            else
            {
                if(chisUnknown)
                {
                    var cont = 1;
                }
                else
                {
                    if(inputFullName.length > 5 && inputAge > 0)
                    {
                        var cont = 1;
                    }
                    else
                    {
                        var cont = 2;
                    }
                }

                // check tests for gcs4,5
                if(haveTests)
                {
                    if(! tests)
                    {
                        cont = 3;
                    }
                }
            }

        }
        else
        {
            var cont = 2;
        }
        if(cont == 1)
        {
            document.addPatientForm.submit();
        }
        else if(cont == 2)
        {
            $('#dangerAlert').show();
        }
        else if(cont == 3)
        {
            $('#dangerAlert2').show();
        }

    });

}

// add new patient
function addPatientOI()
{
    insertDoc('cbDoc', false);
    $('#cbDoc').on('change', function(){
        changeDoc();
    });
    $('#cbTol').on('change', function(){
        insertDocOption('cbPatientStatus', 'cbTol', false, false);
        if($('#cbTol').val() == 1)
        {
            $('#cbBreathing').val('N');
            $('#cbCornea').val('N');
            $('#cbFaceMove').val('N');
            $('#cbBodyMove').val('N');
            $('#cbDoll').val('N');
            $('#cbGag').val('N');
            $('#cbCough').val('N');
            $('#cbPupil').val('N');
            //$('#GCS3Patients').show();
            //$('#firstSedationQ').hide();
        }
        else
        {
            $('#cbBreathing').val('U');
            $('#cbCornea').val('U');
            $('#cbFaceMove').val('U');
            $('#cbBodyMove').val('U');
            $('#cbDoll').val('U');
            $('#cbGag').val('U');
            $('#cbCough').val('U');
            $('#cbPupil').val('U');
            //$('#GCS3Patients').hide();
            //$('#firstSedationQ').show();
        }
    });

    // disable BUN or Urea
    $('#inputBUN').on('blur', function(){
        if($('#inputBUN').val() >= 0 && $('#inputBUN').val() <= 200 && $('#inputBUN').val().length > 0)
        {
            $('#inputUrea').attr('disabled', 'disabled').val('');
        }
        else
        {
            $('#inputUrea').removeAttr('disabled', 'disabled').val('');
        }
    });
    $('#inputUrea').on('blur', function(){
        if($('#inputUrea').val() >= 0 && $('#inputUrea').val() <= 500 && $('#inputUrea').val().length > 0)
        {
            $('#inputBUN').attr('disabled', 'disabled').val('');
        }
        else
        {
            $('#inputBUN').removeAttr('disabled', 'disabled').val('');
        }
    });
    // disable BUN or Urea

    $('#chisUnknown').on('change', function(){
        if($('#chisUnknown').is(':checked'))
        {
            $('#inputFullName').attr('disabled', 'disabled');
            $('#inputNationalCode').attr('disabled', 'disabled');
            $('#inputAge').attr('disabled', 'disabled');
        }
        else
        {
            $('#inputFullName').removeAttr('disabled', 'disabled');
            $('#inputNationalCode').removeAttr('disabled', 'disabled');
            $('#inputAge').removeAttr('disabled', 'disabled');
        }
    });

    $('#inputFullName').on('blur', function(){
        var ptName = $('#inputFullName').val();
        $('#warningAlertName').hide();
        $.ajax({
            dataType: "json",
            type: "POST",
            url: base_url() + "ajax/ajax_conf/found_patient_result",
            cache: false,
            data: {pName: ptName}
        }).done(function(Data){
            if(Data.num_rows > 0)
            {
                var url = base_url() + Data.url + '/manage_patient?inputPatientFilter=' + ptName + '&searchTools=true';
                $('#warningAlertName').html(Data.num_rows + ' عدد بیمار با نام وارد شده یافت شد، برای مشاهده بیماران ' + '<a target="_blank" href="' + url + '">اینجا</a>' + ' کلیک نمائید.');
                $('#warningAlertName').show();
            }
            else
            {
                $('#warningAlertName').hide();
            }
        });
    });
    $('#cbPatientStatus').on('change', function(){
        changePatientStatus();
    });

    $('#saveBTN').unbind('click').bind('click', function(){
        $('#dangerAlert').hide();
        $('#dangerAlert2').hide();
        var chisUnknown = $('#chisUnknown').is(':checked'); /////// is checked
        var inputFileNumber = $('#inputFileNumber').val();
        var inputFullName = $('#inputFullName').val();
        var inputNationalCode = $('#inputNationalCode').val();
        var inputAge = $('#inputAge').val();
        var cbBodyType = $('#cbBodyType').val();
        var cbDoc = $('#cbDoc').val();
        var inputDocDetail = $('#inputDocDetail').val(); // check shavad
        var inputFirstGCS = $('#inputFirstGCS').val();
        var cbPresentioan = $('#cbPresentioan').val();
        var cbHospitals = $('#cbHospitals').val();
        var cbSection = $('#cbSection').val();
        var inputTypeOfSection = $('#inputTypeOfSection').val();
        var cbBreathing = $('#cbBreathing').val();
        var inputBreathingDetail = $('#inputBreathingDetail').val();
        var cbSedation = $('#cbSedation').is(':checked'); /////// is checked
        var cbBodyMove = $('#cbBodyMove').val();
        var inputBodyMovementDetail = $('#inputBodyMovementDetail').val();
        var cbFaceMove = $('#cbFaceMove').val();
        var inputFaceMovementDetail = $('#inputFaceMovementDetail').val();
        var cbGag = $('#cbGag').val();
        var cbCough = $('#cbCough').val();
        var cbCornea = $('#cbCornea').val();
        var cbPupil = $('#cbPupil').val();
        var cbTol = $('#cbTol').val();
        var cbMin = $('#cbMin').val();
        var cbHour = $('#cbHour').val();
        var cbPatientStatus = $('#cbPatientStatus').val();
        var inputT = $('#inputT').val();
        var inputPR = $('#inputPR').val();
        var inputFIO2 = $('#inputFIO2').val();
        var inputOut = $('#inputOut').val();
        var inputBPb = $('#inputBPb').val();
        var inputBPp = $('#inputBPp').val();
        var inputRR = $('#inputRR').val();
        var inputO2SAT = $('#inputO2SAT').val();
        var cbSedation2 = $('#cbSedation2').val();
        var inputNa = $('#inputNa').val();
        var inputK = $('#inputK').val();
        var inputBUN = $('#inputBUN').val();
        var inputUrea = $('#inputUrea').val();
        var inputCr = $('#inputCr').val();
        var inputCa = $('#inputCa').val();
        var inputALT = $('#inputALT').val();
        var inputAST = $('#inputAST').val();
        var inputHb = $('#inputHb').val();
        var inputWBC = $('#inputWBC').val();
        var inputPLT = $('#inputPLT').val();
        var inputBs = $('#inputBs').val();

        var tests = 0;
        if(inputT >= 20 && inputT <= 50 &&
            inputRR >= 0 && inputRR <= 100 &&
            inputPR >= 0 && inputPR <= 200 &&
            inputFIO2 >= 0 && inputFIO2 <= 100 &&
            inputOut >= 0 && inputOut <= 3000 &&
            inputBPb >= 0 && inputBPb <= 300 &&
            inputBPp >= 0 && inputBPp <= 200 &&
            inputO2SAT >= 0 && inputO2SAT <= 100 &&
            inputNa >= 0 && inputNa <= 300 &&
            inputK >= 0 && inputK <= 20 &&
            ((inputBUN >= 0 && inputBUN <= 200) || (inputUrea >= 0 && inputUrea <= 500)) &&
            inputALT >= 0 && inputALT <= 2000 &&
            inputAST >= 0 && inputAST <= 2000 &&
            inputHb >= 0 && inputHb <= 30 &&
            inputWBC >= 0 && inputWBC <= 100000 &&
            inputPLT >= 1000 && inputPLT <= 999000 &&
            inputBs >= 0 && inputBs <= 1000 &&
            inputCr >= 0 && inputCr <= 20 &&
            inputCa >= 0 && inputCa <= 20)
        {
            tests = 1;
        }
        else
        {
            tests = 0;
        }

        var haveTests = 0;
        if(inputT.length > 0 || inputRR.length > 0 || inputPR.length > 0 || inputFIO2.length > 0 || inputOut.length > 0 ||
            inputBPb.length > 0 || inputBPp.length > 0 || inputO2SAT.length > 0 || inputNa.length > 0 || inputK.length > 0 ||
            inputALT.length > 0 || inputAST.length > 0 || inputHb.length > 0 || inputWBC.length > 0 || inputPLT.length > 0 ||
            inputBs.length > 0 || inputCr.length > 0 || inputCa.length > 0 || inputBUN.length > 0 || inputUrea.length > 0)
        {
            haveTests = 1;
        }
        else
        {
            haveTests = 0;
        }


        if($('#rdAddDate1').is(':checked'))
        {
            var rdDate = 'toDay';
        }
        else if($('#rdAddDate2').is(':checked'))
        {
            var rdDate = 'lastDay';
        }
        else
        {
            var rdDate = false;
        }


        if(inputFileNumber.length > 0 && cbDoc > 0 && inputFirstGCS >= 3 && inputFirstGCS <= 15 && cbPresentioan > 0 && cbHospitals > 0 && cbSection > 0 && cbTol > 0 && cbPatientStatus > 0 && cbMin != 'min' && cbHour != 'hour')
        {
            if($('#cbTol').val() == 4 || $('#cbTol').val() == 1 || $('#cbTol').val() == 2)
            {
                if(tests && haveTests)
                {
                    if(chisUnknown)
                    {
                        var cont = 1;
                    }
                    else
                    {
                        if(inputFullName.length > 5 && inputAge > 0)
                        {
                            var cont = 1;
                        }
                        else
                        {
                            var cont = 2;
                        }
                    }
                }
                else
                {
                    var cont = 3;
                }
            }
            else
            {
                if(chisUnknown)
                {
                    var cont = 1;
                }
                else
                {
                    if(inputFullName.length > 5 && inputAge > 0)
                    {
                        var cont = 1;
                    }
                    else
                    {
                        var cont = 2;
                    }
                }

                // check tests for gcs4,5
                if(haveTests)
                {
                    if(! tests)
                    {
                        cont = 3;
                    }
                }
            }

        }
        else
        {
            var cont = 2;
        }
        if(cont == 1)
        {
            document.addPatientForm.submit();
        }
        else if(cont == 2)
        {
            $('#dangerAlert').show();
        }
        else if(cont == 3)
        {
            $('#dangerAlert2').show();
        }

    });
    
}

// change user password
function changeUserPassword()
{
    var oldPassword = $('#inputLastPassword').val();
    var newPassword = $('#inputNewPassword').val();
    var newPassword2 = $('#inputNewPassword2').val();
    var danger1 = $('#danger1');
    var danger2 = $('#danger2');
    var danger3 = $('#danger3');
    danger1.hide();
    danger2.hide();
    danger3.hide();
    if(oldPassword.length > 5)
    {
        if(newPassword.length > 5)
        {
            if(newPassword == newPassword2)
            {
                document.changeUserPass.submit();
            }
            else
            {
                danger1.show();
            }
        }
        else
        {
            danger3.show();
        }
    }
    else
    {
        danger2.show();
    }
}

// active or inactive or delete inspector
function inactiveInspector(inspectorID, status)
{
    var name = $('#insName' + inspectorID).text();
    var saveBTN = $('#inactiveBTN');
    var inactiveDeleteBTN = $('#inactiveDeleteBTN');
    var saveLoading = $('#activeInspectorModalLoading');
    var divQes = $('#activeQuestion');
    var danger1 = $('#dangerAlertStatus1');
    var danger2 = $('#dangerAlertStatus2');
    var danger3 = $('#dangerAlertStatus3');
    saveBTN.removeAttr('disabled', 'disabled');
    inactiveDeleteBTN.removeAttr('disabled', 'disabled');
    saveBTN.hide();
    inactiveDeleteBTN.hide();
    saveLoading.hide();
    danger1.hide();
    danger2.hide();
    danger3.hide();
    if(status == 'inactive')
    {
        var tx = 'آیا مایل به غیرفعال نمودن بازرس <span style="font-weight: bold; color: #2B689B;">' + name + '</span> می‌باشید؟';
    }
    else if(status == 'active')
    {
        var tx = 'آیا مایل به فعال نمودن بازرس <span style="font-weight: bold; color: #2B689B;">' + name + '</span> می‌باشید؟';
    }
    else if(status == 'delete')
    {
        var tx = 'آیا مایل به حذف کردن بازرس <span style="font-weight: bold; color: #2B689B;">' + name + '</span> می‌باشید؟';
    }
    
    divQes.html(tx);
    divQes.show();
    
    if(status == 'delete')
    {
        saveBTN.hide();
        inactiveDeleteBTN.show();
        inactiveDeleteBTN.unbind('click').bind('click', function(){
            inactiveDeleteBTN.attr('disabled', 'disabled');
            divQes.hide();
            saveLoading.show();
            var j = 1;
            if(j > 0)
            {
                $.ajax({
                type: "POST",
                url: base_url() + "ajax/ajax_conf/change_inspector_status",
                cache: false,
                data: {insID: inspectorID, insStatus: status}
                }).done(function(Data){
                    inactiveDeleteBTN.removeAttr('disabled', 'disabled');
                    saveLoading.hide();
                    if(Data == 1)
                    {
                        danger1.show();
                    }
                    else if(Data == 2)
                    {
                        danger2.show();
                    }
                    else if(Data == 3)
                    {
                        danger3.show();
                        setTimeout(function(){
                               window.location.reload(1);
                            }, 5000);
                    }
                });
                j--;
            }
        });
    }
    else
    {
        saveBTN.show();
        inactiveDeleteBTN.hide();
        saveBTN.unbind('click').bind('click', function(){
            saveBTN.attr('disabled', 'disabled');
            divQes.hide();
            saveLoading.show();
            $.ajax({
                type: "POST",
                url: base_url() + "ajax/ajax_conf/change_inspector_status",
                cache: false,
                data: {insID: inspectorID, insStatus: status}
                }).done(function(Data){
                    saveBTN.removeAttr('disabled', 'disabled');
                    saveLoading.hide();
                    if(Data == 1)
                    {
                        danger1.show();
                    }
                    else if(Data == 2)
                    {
                        danger2.show();
                    }
                    else if(Data == 3)
                    {
                        danger3.show();
                        setTimeout(function(){
                               window.location.reload(1);
                            }, 5000);
                    }
                });
        });
    }
}

// active or inactive or delete opu
function inactiveInspector(inspectorID, status)
{
    var name = $('#insName' + inspectorID).text();
    var saveBTN = $('#inactiveBTN');
    var inactiveDeleteBTN = $('#inactiveDeleteBTN');
    var saveLoading = $('#activeInspectorModalLoading');
    var divQes = $('#activeQuestion');
    var danger1 = $('#dangerAlertStatus1');
    var danger2 = $('#dangerAlertStatus2');
    var danger3 = $('#dangerAlertStatus3');
    saveBTN.removeAttr('disabled', 'disabled');
    inactiveDeleteBTN.removeAttr('disabled', 'disabled');
    saveBTN.hide();
    inactiveDeleteBTN.hide();
    saveLoading.hide();
    danger1.hide();
    danger2.hide();
    danger3.hide();
    if(status == 'inactive')
    {
        var tx = 'آیا مایل به غیرفعال نمودن بازرس <span style="font-weight: bold; color: #2B689B;">' + name + '</span> می‌باشید؟';
    }
    else if(status == 'active')
    {
        var tx = 'آیا مایل به فعال نمودن بازرس <span style="font-weight: bold; color: #2B689B;">' + name + '</span> می‌باشید؟';
    }
    else if(status == 'delete')
    {
        var tx = 'آیا مایل به حذف کردن بازرس <span style="font-weight: bold; color: #2B689B;">' + name + '</span> می‌باشید؟';
    }
    
    divQes.html(tx);
    divQes.show();
    
    if(status == 'delete')
    {
        saveBTN.hide();
        inactiveDeleteBTN.show();
        inactiveDeleteBTN.unbind('click').bind('click', function(){
            inactiveDeleteBTN.attr('disabled', 'disabled');
            divQes.hide();
            saveLoading.show();
            var j = 1;
            if(j > 0)
            {
                $.ajax({
                type: "POST",
                url: base_url() + "ajax/ajax_conf/change_inspector_status",
                cache: false,
                data: {insID: inspectorID, insStatus: status}
                }).done(function(Data){
                    inactiveDeleteBTN.removeAttr('disabled', 'disabled');
                    saveLoading.hide();
                    if(Data == 1)
                    {
                        danger1.show();
                    }
                    else if(Data == 2)
                    {
                        danger2.show();
                    }
                    else if(Data == 3)
                    {
                        danger3.show();
                        setTimeout(function(){
                               window.location.reload(1);
                            }, 5000);
                    }
                });
                j--;
            }
        });
    }
    else
    {
        saveBTN.show();
        inactiveDeleteBTN.hide();
        saveBTN.unbind('click').bind('click', function(){
            saveBTN.attr('disabled', 'disabled');
            divQes.hide();
            saveLoading.show();
            var l = 1;
            if(l > 0)
            {
                $.ajax({
                type: "POST",
                url: base_url() + "ajax/ajax_conf/change_inspector_status",
                cache: false,
                data: {insID: inspectorID, insStatus: status}
                }).done(function(Data){
                    saveBTN.removeAttr('disabled', 'disabled');
                    saveLoading.hide();
                    if(Data == 1)
                    {
                        danger1.show();
                    }
                    else if(Data == 2)
                    {
                        danger2.show();
                    }
                    else if(Data == 3)
                    {
                        danger3.show();
                        setTimeout(function(){
                               window.location.reload(1);
                            }, 5000);
                    }
                });
                l--;
            }
        });
    }
}

// active or inactive or delete opu
function inactiveOpu(opuID, status)
{
    var name = $('#opuName' + opuID).text();
    var saveBTN = $('#inactiveBTN');
    var inactiveDeleteBTN = $('#inactiveDeleteBTN');
    var saveLoading = $('#activeInspectorModalLoading');
    var divQes = $('#activeQuestion');
    var danger1 = $('#dangerAlertStatus1');
    var danger2 = $('#dangerAlertStatus2');
    var danger3 = $('#dangerAlertStatus3');
    saveBTN.removeAttr('disabled', 'disabled');
    inactiveDeleteBTN.removeAttr('disabled', 'disabled');
    saveBTN.hide();
    inactiveDeleteBTN.hide();
    saveLoading.hide();
    danger1.hide();
    danger2.hide();
    danger3.hide();
    if(status == 'inactive')
    {
        var tx = 'آیا مایل به غیرفعال نمودن واحد فراهم آوری <span style="font-weight: bold; color: #2B689B;">' + name + '</span> می‌باشید؟ <br> توجه داشته باشید در صورت غیر فعال نمودن این واحد تمامی بازرسین ثبت شده در این واحد نیز غیر فعال می گردند.';
    }
    else if(status == 'active')
    {
        var tx = 'آیا مایل به فعال نمودن واحد فراهم آوری <span style="font-weight: bold; color: #2B689B;">' + name + '</span> می‌باشید؟ <br> توجه داشته باشید در صورت فعال نمودن این واحد فراهم آوری تمامی بازرسین آن نیز فعال می گردند.';
    }
    else if(status == 'delete')
    {
        var tx = 'آیا مایل به حذف کردن واحد فراهم آوری <span style="font-weight: bold; color: #2B689B;">' + name + '</span> می‌باشید؟ <br> توجه داشته باشید در صورت حذف کردن این واحد فراهم آوری تمامی بازرسین آن نیز حذف می کردند.';
    }
    
    divQes.html(tx);
    divQes.show();
    
    if(status == 'delete')
    {
        saveBTN.hide();
        inactiveDeleteBTN.show();
        inactiveDeleteBTN.unbind('click').bind('click', function(){
            inactiveDeleteBTN.attr('disabled', 'disabled');
            divQes.hide();
            saveLoading.show();
            var j = 1;
            if( j > 0)
            {
                $.ajax({
                type: "POST",
                url: base_url() + "ajax/ajax_conf/change_opu_status",
                cache: false,
                data: {opuId: opuID, opuStatus: status}
                }).done(function(Data){
                    inactiveDeleteBTN.removeAttr('disabled', 'disabled');
                    saveLoading.hide();
                    if(Data == 2)
                    {
                        danger1.show();
                    }
                    else if(Data == 3)
                    {
                        danger3.show();
                        setTimeout(function(){
                               window.location.reload(1);
                            }, 5000);
                    }
                });
                j--;
            }
        });
    }
    else
    {
        saveBTN.show();
        inactiveDeleteBTN.hide();
        saveBTN.unbind('click').bind('click', function(){
            saveBTN.attr('disabled', 'disabled');
            divQes.hide();
            saveLoading.show();
            var l = 1;
            if(l > 0)
            {
                $.ajax({
                type: "POST",
                url: base_url() + "ajax/ajax_conf/change_opu_status",
                cache: false,
                data: {opuId: opuID, opuStatus: status}
                }).done(function(Data){
                    saveBTN.removeAttr('disabled', 'disabled');
                    saveLoading.hide();
                    if(Data == 2)
                    {
                        danger1.show();
                    }
                    else if(Data == 3)
                    {
                        danger3.show();
                        setTimeout(function(){
                               window.location.reload(1);
                            }, 5000);
                    }
                });
                l--;
            }
        });
    }
}

// delete state or city
function deleteStateOrCity(id)
{
    var load = $('#deleteStateModalLoading');
    var qoes = $('#deleteStateModalActiveQuestion');
    var danger1 = $('#deleteStateModalDanger1');
    var danger2 = $('#deleteStateModalDanger3');
    var btn = $('#deleteStateModalBTN');
    var name = $('#cityName' + id).text();
    var j = 1;
    load.hide();
    danger1.hide();
    danger2.hide();
    btn.removeAttr('disabled', 'disabled');
    var x = 'آیا مایل به حذف استان / شهر <span style="font-weight: bold; color: #2B689B;">' + name + '</span> می باشید؟';
    qoes.html(x);
    
    if(id > 0 && j > 0)
    {
        btn.unbind('click').bind('click', function(){
            load.show();
            btn.attr('disabled', 'disabled');
            $.ajax({
                    type: "POST",
                    url: base_url() + "ajax/ajax_conf/delete_state_or_city",
                    cache: false,
                    data: {sID: id}
                    }).done(function(Data){
                        btn.removeAttr('disabled', 'disabled');
                        load.hide();
                        if(Data == 1)
                        {
                            danger2.show();
                            setTimeout(function(){
                                   window.location.reload(1);
                                }, 2500);
                        }
                        else if(Data == 2)
                        {
                            danger1.show();
                        }
                    });
            j--;
        });
    }
}

// change modal height in edit patient page
function changeHeightModal(id)
{
    he = $(window).height();
    heM = $('#' + id + ' .modal-content').height();
    if(heM > he)
    {
        $('#' + id + ' .modal-backdrop').height($('#' + id + ' .modal-content').height() + 100);
    }
    else
    {
        $('#' + id + ' .modal-backdrop').height(he + 50);
    }
}

// edit and modify patient
function editPatient(id)
{
    document.editPatientForms.reset();
    document.patientTransferForm.reset();
    var saveBTN = $('#saveBTN');
    var transferBTN = $('#transferBTN');
    var transferSaveBTN = $('#transferSaveBTN');
    var transferForm = $('#patientsTransfer');
    var GCS3Patients = $('#GCS3Patients');
    saveBTN.attr('disabled', 'disabled');
    var form = $('#editPatientFrom');
    var loading = $('#editPatientModalLoading');
    var chUn = $('#chisUnknown');
    var inputFileNumber = $('#inputFileNumber');
    var inputPT = $('#inputPT');
    var inputFullName = $('#inputFullName');
    var inputNationalCode = $('#inputNationalCode');
    var inputAge = $('#inputAge');
    var cbBodyType = $('#cbBodyType');
    var inputFirstGCS = $('#inputFirstGCS');
    var inputSecondGCS = $('#inputSecondGCS');
    var inputCoordinatorName = $('#inputCoordinatorName');
    var cbDoc = $('#cbDoc');
    var inputPatientDetail = $('#inputPatientDetail');
    var cbOpu = $('#cbOpuEdit');
    var cbHospitals = $('#cbHospitalsEdit');
    var cbSection = $('#cbSectionEdit');
    var inputTypeOfSection = $('#inputTypeOfSection');
    var cbPresentioan = $('#cbPresentioan');
    var cbBreathing = $('#cbBreathing');
    var inputBreathingDetail = $('#inputBreathingDetail');
    var cbCornea = $('#cbCornea');
    var cbPupil = $('#cbPupil');
    var cbFaceMove = $('#cbFaceMove');
    var inputFaceMovementDetail = $('#inputFaceMovementDetail');
    var cbBodyMove = $('#cbBodyMove');
    var inputBodyMovementDetail = $('#inputBodyMovementDetail');
    var cbDoll = $('#cbDoll');
    var cbGag = $('#cbGag');
    var cbCough = $('#cbCough');
    var cbTol = $('#cbTol');
    var cbPatientStatus = $('#cbPatientStatusEdit');
    var inputT = $('#inputT');
    var inputPR = $('#inputPR');
    var inputFIO2 = $('#inputFIO2');
    var inputBPb = $('#inputBPb');
    var inputBPp = $('#inputBPp');
    var inputRR = $('#inputRR');
    var inputO2SAT = $('#inputO2SAT');
    var cbSedation2 = $('#cbSedation2');
    var inputNa = $('#inputNa');
    var inputBUN = $('#inputBUN');
    var inputUrea = $('#inputUrea');
    var inputALT = $('#inputALT');
    var inputWBC = $('#inputWBC');
    var inputHb = $('#inputHb');
    var inputK = $('#inputK');
    var inputCr = $('#inputCr');
    var inputCa = $('#inputCa');
    var inputAST = $('#inputAST');
    var inputPLT = $('#inputPLT');
    var inputBs = $('#inputBs');
    var inputOut = $('#inputOut');
    var pcal1 = $('#pcal1'); // tarikh bastari
    var pcal2 = $('#pcal2'); // tarikh elame gcs3 tavasote pezeshke moalej
    var pcal3 = $('#pcal3'); // tarikhe shenasaee marge maghzi
    var pcal4 = $('#pcal4'); // tarikhe enteghal
    var pcal5 = $('#pcal5'); // tarikh ehda
    var pcal6 = $('#pcal6'); // tarkh marge ghalbi
    var cbTransferState = $('#cbTransferState');
    var cbTransferCity = $('#cbTransferCity');
    var cbTransferHospital = $('#cbTransferHospital');
    var dangerAlert = $('#dangerAlert');
    var successAlert = $('#successAlert');
    var chHeart = $('#chHeart');
    var chLiver = $('#chLiver');
    var chKidneyRight = $('#chKidneyRight');
    var chKidneyLeft = $('#chKidneyLeft');
    var chLungRight = $('#chLungRight');
    var chLungLeft = $('#chLungLeft');
    var chPancreas = $('#chPancreas');
    var chTissue = $('#chTissue');
    var chBowel = $('#chBowel');
    var appRegisterTime = $('#appRegisterTime');
    var Err = 0;
    inputFullName.removeAttr('disabled', 'disabled');
    inputNationalCode.removeAttr('disabled', 'disabled');
    inputAge.removeAttr('disabled', 'disabled');
    transferBTN.show();
    saveBTN.show();
    transferForm.hide();
    transferSaveBTN.hide();
    form.hide();
    dangerAlert.hide();
    successAlert.hide();
    var exp = 1; // $('#viewPatientLogModal').modal('handleUpdate');
    if(id > 0)
    {
        var j = 1;
        if(j > 0)
        {
            $.ajax({
            dataType: "json",
            type: "POST",
            url: base_url() + "ajax/ajax_conf/load_one_patient",
            cache: false,
            data: {pID: id}
            }).done(function(Data){
                // result
                if(Data.isUnKnown == 1)
                {
                    chUn.click();
                }
                else
                {
                    inputFullName.val(Data.fullName);
                    inputNationalCode.val(Data.nationalCode);
                    inputAge.val(Data.age);
                }
                inputFileNumber.val(Data.fileNumber)
                cbBodyType.val(Data.bodyType);
                inputFirstGCS.val(Data.firstGCS);
                inputSecondGCS.val(Data.secondGCS);
                inputCoordinatorName.val(Data.coordinatorName);
                insertDoc('cbDoc', Data.doc);
                if(Data.doc == 8)
                {
                    $('#inputDocDetail').val(Data.docDetail);
                    $('#inputDocDetail').show();
                }
                else
                {
                    $('#inputDocDetail').hide();
                }
                inputPatientDetail.val(Data.patientDetail);
                insertHospital('cbHospitalsEdit', Data.opuId, Data.hospital, 'opuId');
                cbSection.val(Data.section);
                inputTypeOfSection.val(Data.typeOfSection);
                cbPresentioan.val(Data.presentation);
                cbBreathing.val(Data.breathing);
                inputBreathingDetail.val(Data.breathingDetail);
                cbCornea.val(Data.cornea);
                cbPupil.val(Data.pupil);
                cbFaceMove.val(Data.faceMovement);
                inputFaceMovementDetail.val(Data.faceMovementDetail);
                cbBodyMove.val(Data.bodyMovement);
                inputBodyMovementDetail.val(Data.bodyMovementDetail);
                cbDoll.val(Data.dollEye);
                cbGag.val(Data.gag);
                cbCough.val(Data.cough);
                inputPT.val(id);
                if(Data.sedation == 'Yes')
                {
                    cbSedation2.click();
                }
                cbTol.val(Data.tol);
                insertDocOption('cbPatientStatusEdit', Data.tol, Data.patientStatus, 'ALL');
                if(Data.patientStatus == 22)
                {
                    $('#inputPatientStatusDetail').val(Data.patientStatusDetail);
                    $('#inputPatientStatusDetail').show();
                }
                else
                {
                    $('#inputPatientStatusDetail').hide();
                }

                // patient test and organs
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: base_url() + "ajax/ajax_conf/load_one_patient_extra_data",
                    cache: false,
                    data: {pID: id}
                }).done(function(p){
                    // result
                    if(p.isTest == 1)
                    {
                        inputNa.val(p.test.na);
                        if(p.test.bun > 0)
                        {
                            inputBUN.val(p.test.bun).removeAttr('disabled', 'disabled');
                            inputUrea.val('').attr('disabled', 'disabled');
                        }
                        else if(p.test.urea > 0)
                        {
                            inputBUN.val('').attr('disabled', 'disabled');
                            inputUrea.val(p.test.urea).removeAttr('disabled', 'disabled');
                        }


                        inputALT.val(p.test.alt);
                        inputWBC.val(p.test.wbc);
                        inputHb.val(p.test.hb);
                        inputK.val(p.test.k);
                        inputCr.val(p.test.cr);
                        inputCa.val(p.test.ca);
                        inputAST.val(p.test.ast);
                        inputPLT.val(p.test.plt);
                        inputBs.val(p.test.bs);

                        inputT.val(p.test.t);
                        inputPR.val(p.test.pr);
                        inputFIO2.val(p.test.fio2);
                        inputBPb.val(p.test.b);
                        inputBPp.val(p.test.p);
                        inputRR.val(p.test.rr);
                        inputO2SAT.val(p.test.o2sat);
                        inputOut.val(p.test.out);
                    }
                    if(p.isOrgan == 1)
                    {
                        if(p.organ.heart == 1)
                        {
                            chHeart.click();
                        }
                        if(p.organ.liver == 1)
                        {
                            chLiver.click();
                        }
                        if(p.organ.kidneyRight == 1)
                        {
                            chKidneyRight.click();
                        }
                        if(p.organ.kidneyLeft == 1)
                        {
                            chKidneyLeft.click();
                        }
                        if(p.organ.lungRight == 1)
                        {
                            chLungRight.click();
                        }
                        if(p.organ.lungLeft == 1)
                        {
                            chLungLeft.click();
                        }
                        if(p.organ.pancreas == 1)
                        {
                            chPancreas.click();
                        }
                        if(p.organ.tissue == 1)
                        {
                            chTissue.click();
                        }
                        if(p.organ.bowel == 1)
                        {
                            chBowel.click();
                        }
                    }
                });

                pcal1.val(Data.hospitalizationTime);
                pcal2.val(Data.gcs3ByDrTime);
                pcal3.val(Data.brainDeathTime);
                pcal5.val(Data.organDonationTime);
                pcal6.val(Data.cardiacDeathTime);

                // show date input
                $('#organDonationDate').show();
                $('#cardiacDeathDate').show();
                $('#hospitalizationDate').show();
                $('#gcs3ByDrData').show();
                $('#foundGcs3Date').show();
                if(Data.patientStatus == 6)
                {
                    $('#cardiacDeathDate').hide();
                    $('#patientOrgansSection').show();
                }
                else if(Data.patientStatus == 10 || Data.patientStatus == 11 || Data.patientStatus == 12 || Data.patientStatus == 13 || Data.patientStatus == 14 || Data.patientStatus == 15 || Data.patientStatus == 9 || Data.patientStatus == 23 || Data.patientStatus == 3)
                {
                    if(Data.tol == 1)
                    {
                        $('#organDonationDate').hide();
                    }
                    else
                    {
                        $('#organDonationDate').hide();
                        $('#gcs3ByDrData').hide();
                        $('#foundGcs3Date').hide();
                    }
                    $('#patientOrgansSection').hide();
                }
                else
                {
                    if(Data.tol == 1)
                    {
                        $('#organDonationDate').hide();
                        $('#cardiacDeathDate').hide();
                    }
                    else
                    {
                        $('#gcs3ByDrData').hide();
                        $('#foundGcs3Date').hide();
                        $('#organDonationDate').hide();
                        $('#cardiacDeathDate').hide();
                    }
                    $('#patientOrgansSection').hide();
                }
                // show date input

                appRegisterTime.text(Data.appRegisterTime);
                loading.hide();
                form.show();
                saveBTN.removeAttr('disabled', 'disabled');
                transferBTN.removeAttr('disabled', 'disabled');
                $('#editPatientModal').modal('handleUpdate');
            }).fail(function(){
                dangerAlert.text('خطایی در دریافت اطلاعات بیمار رخ داده است، لطفاً دوباره تلاش نمائید.');
                loading.hide();
            });
            j--;
        }
        
        // on patient transfer btn clicked for transfer that
        transferBTN.unbind('click').bind('click', function(){
            saveBTN.hide();
            transferBTN.hide();
            insertState('cbTransferState', false);
            form.hide();
            transferForm.show();
            transferSaveBTN.show();
            $('#editPatientModal').modal('handleUpdate');
        });
        
        // on patient save transfer btn clicked
        transferSaveBTN.unbind('click').bind('click', function(){
            dangerAlert.hide();
            if(cbTransferState.val() > 0 && cbTransferCity.val() > 0 && cbTransferHospital.val() > 0 && pcal4.val().length > 6)
            {
                transferSaveBTN.attr('disabled', 'disabled');
                loading.show();
                $('#editPatientModal').modal('handleUpdate');
                if(exp > 0)
                {
                    $.ajax({
                        type: "POST",
                        url: base_url() + "ajax/ajax_conf/transfer_patient",
                        cache: false,
                        data: {cbTCity: cbTransferCity.val(), cbTState: cbTransferState.val(), cbTHospital: cbTransferHospital.val(), tTime: pcal4.val(), pId: id}
                        }).done(function(Data){
                            if(Data == 1)
                            {
                                successAlert.text('بیمار مورد نظر با موفقیت منتقل شد، پس از تایید مسئول سامانه به واحد جدید اطلاع داده می شود.');
                                loading.hide();
                                successAlert.show();
                                setTimeout(function(){
                                   window.location.reload(1);
                                }, 5000);
                            }
                            else
                            {
                                dangerAlert.text('خطایی در مراحل انتقال بیمار رخ داده است، لطفاً دوباره تلاش نمائید.');
                                loading.hide();
                                dangerAlert.show();
                            }
                        });
                        exp--;
                }
            }
            else
            {
                dangerAlert.text('لطفاً تمامی موارد را به درستی تکمیل نمائید.');
                dangerAlert.show();
                $('#editPatientModal').modal('handleUpdate');
            }
        });

        // disable BUN or Urea
        inputBUN.on('blur', function(){
            if(inputBUN.val() >= 0 && inputBUN.val() <= 200 && inputBUN.val().length > 0)
            {
                inputUrea.attr('disabled', 'disabled').val('');
            }
            else
            {
                inputUrea.removeAttr('disabled', 'disabled').val('');
            }
        });
        inputUrea.on('blur', function(){
            if(inputUrea.val() >= 0 && inputUrea.val() <= 500 && inputUrea.val().length > 0)
            {
                inputBUN.attr('disabled', 'disabled').val('');
            }
            else
            {
                inputBUN.removeAttr('disabled', 'disabled').val('');
            }
        });
        // disable BUN or Urea
        
        // hide extera date input and organs section
        cbPatientStatus.on('change', function () {
            $('#organDonationDate').show();
            $('#cardiacDeathDate').show();
            $('#hospitalizationDate').show();
            $('#gcs3ByDrData').show();
            $('#foundGcs3Date').show();
            if(cbPatientStatus.val() == 6)
            {
                $('#cardiacDeathDate').hide();
                $('#patientOrgansSection').show();
            }
            else if(cbPatientStatus.val() == 10 || cbPatientStatus.val() == 11 || cbPatientStatus.val() == 12 || cbPatientStatus.val() == 13 || cbPatientStatus.val() == 14 || cbPatientStatus.val() == 15 || cbPatientStatus.val() == 9 || cbPatientStatus.val() == 23 || cbPatientStatus.val() == 3)
            {
                if(cbTol.val() == 1)
                {
                    $('#organDonationDate').hide();
                }
                else
                {
                    $('#organDonationDate').hide();
                    $('#gcs3ByDrData').hide();
                    $('#foundGcs3Date').hide();
                }
                $('#patientOrgansSection').hide();
            }
            else
            {
                if(cbTol.val() == 1)
                {
                    $('#organDonationDate').hide();
                    $('#cardiacDeathDate').hide();
                }
                else
                {
                    $('#gcs3ByDrData').hide();
                    $('#foundGcs3Date').hide();
                    $('#organDonationDate').hide();
                    $('#cardiacDeathDate').hide();
                }
                $('#patientOrgansSection').hide();
            }
            $('#editPatientModal').modal('handleUpdate');
        });
        // hide extera date input

        // on save btn clicked for save data
        saveBTN.unbind('click').bind('click', function(){
            saveBTN.attr('disabled', 'disabled');
            transferBTN.attr('disabled', 'disabled');
            dangerAlert.hide();
            loading.show();
            $('#editPatientModal').modal('handleUpdate');
            Err = 0;

            // patient tests
            var tests = 0;
            if(inputT.val() >= 20 && inputT.val() <= 50 &&
                inputRR.val() >= 0 && inputRR.val() <= 100 &&
                inputPR.val() >= 0 && inputPR.val() <= 200 &&
                inputFIO2.val() >= 0 && inputFIO2.val() <= 100 &&
                inputOut.val() >= 0 && inputOut.val() <= 3000 &&
                inputBPb.val() >= 0 && inputBPb.val() <= 300 &&
                inputBPp.val() >= 0 && inputBPp.val() <= 200 &&
                inputO2SAT.val() >= 0 && inputO2SAT.val() <= 100 &&
                inputNa.val() >= 0 && inputNa.val() <= 300 &&
                inputK.val() >= 0 && inputK.val() <= 20 &&
                ((inputBUN.val() >= 0 && inputBUN.val() <= 200) || (inputUrea.val() >= 0 && inputUrea.val() <= 500)) &&
                inputALT.val() >= 0 && inputALT.val() <= 2000 &&
                inputAST.val() >= 0 && inputAST.val() <= 2000 &&
                inputHb.val() >= 0 && inputHb.val() <= 30 &&
                inputWBC.val() >= 0 && inputWBC.val() <= 100000 &&
                inputPLT.val() >= 1000 && inputPLT.val() <= 999000 &&
                inputBs.val() >= 0 && inputBs.val() <= 1000 &&
                inputCr.val() >= 0 && inputCr.val() <= 20 &&
                inputCa.val() >= 0 && inputCa.val() <= 20)
            {
                tests = 1;
            }
            else
            {
                tests = 0;
            }

            var haveTests = 0;
            if(inputT.val().length > 0 || inputRR.val().length > 0 || inputPR.val().length > 0 || inputFIO2.val().length > 0 || inputOut.val().length > 0 ||
                inputBPb.val().length > 0 || inputBPp.val().length > 0 || inputO2SAT.val().length > 0 || inputNa.val().length > 0 || inputK.val().length > 0 ||
                inputALT.val().length > 0 || inputAST.val().length > 0 || inputHb.val().length > 0 || inputWBC.val().length > 0 || inputPLT.val().length > 0 ||
                inputBs.val().length > 0 || inputCr.val().length > 0 || inputCa.val().length > 0 || inputBUN.val().length > 0 || inputUrea.val().length > 0)
            {
                haveTests = 1;
            }
            else
            {
                haveTests = 0;
            }
            // patient tests




            // agar bimar montaghel shode nabashad
            if(cbTol.val() > 0 && cbPatientStatus.val() != 5 && cbPatientStatus.val() != 0)
            {
                // check kardan vazeeta paydari va azmayeshate bimar
                if(tests == 1 && haveTests == 1)
                {
                    // vazeeate paydari va azmayeshate bimar vared shod
                    if(cbPatientStatus.val() == 6) // agar bimar vazeeate ehda shode dashte bashad
                    {
                        // validate coordinator name
                        if(inputCoordinatorName.val().length > 5)
                        {
                            // check kardan organ haye ehda shode
                            if(chHeart.is(':checked') || chLiver.is(':checked') || chKidneyRight.is(':checked') ||
                                chKidneyLeft.is(':checked') || chLungRight.is(':checked') || chLungLeft.is(':checked') ||
                                chBowel.is(':checked') || chPancreas.is(':checked') || chTissue.is(':checked'))
                            {
                                // yeki az organ haye ehdaee entekhab shode ast
                                if(pcal1.val().length > 6 && pcal3.val().length > 6 && pcal5.val().length > 6) // baresi tarikh haye ejbari baraye bimare ehda shode
                                {
                                    // tarikhe haye marboot be bimar ehda shode sahih ast
                                    if(! chUn.is(':checked'))
                                    {
                                        if(inputSecondGCS.val() == 3 && cbBreathing.val() == 'N' && cbCornea.val() == 'N' && cbPupil.val() == 'N' && cbFaceMove.val() == 'N' &&
                                        cbBodyMove.val() == 'N' && cbDoll.val() == 'N' && cbGag.val() == 'N' && cbCough.val() == 'N')
                                        {
                                            Err = 0;
                                            inputBreathingDetail.val('');
                                            inputFaceMovementDetail.val('');
                                            inputBodyMovementDetail.val('');
                                        }
                                        else
                                        {
                                            // bimare daraye reflex va GCS gheyre 3 nemitavanad ehda shavad
                                            dangerAlert.text('بیمار با GCS بالاتر از 3 و دارای رفلکس نمی تواند در وضعیت اهدا قرار گیرد.');
                                            loading.hide();
                                            dangerAlert.show();
                                            $('#editPatientModal').modal('handleUpdate');
                                            saveBTN.removeAttr('disabled', 'disabled');
                                            transferBTN.removeAttr('disabled', 'disabled');
                                            Err = 1;
                                        }
                                    }
                                    else
                                    {
                                        // bimare nashenas ghabele ehda nemibashad
                                        dangerAlert.text('بیمار ناشناس قابل اهدا نمی باشد، لطفا اطلاعات را به صورت صحیح وارد نمائید.');
                                        loading.hide();
                                        dangerAlert.show();
                                        $('#editPatientModal').modal('handleUpdate');
                                        saveBTN.removeAttr('disabled', 'disabled');
                                        transferBTN.removeAttr('disabled', 'disabled');
                                        Err = 1;
                                    }
                                }
                                else
                                {
                                    // tarikh haye marboot be bimare ehda shode sahih nemibashad
                                    dangerAlert.text('تاریخ بستری، تاریخ شناسایی مرگ مغزی و تاریخ اهدا را وارد نمائید.');
                                    loading.hide();
                                    dangerAlert.show();
                                    changeHeightModal('editPatientModal');
                                    saveBTN.removeAttr('disabled', 'disabled');
                                    transferBTN.removeAttr('disabled', 'disabled');
                                    Err = 1;
                                }
                                
                            }
                            else
                            {
                                // baraye bimar ehda shode hich organi entekhab nashode
                                dangerAlert.text('برای بیمار با وضعیت اهدا شده می بایست ارگان های اهدایی را نیز انتخاب نمائید.');
                                loading.hide();
                                dangerAlert.show();
                                $('#editPatientModal').modal('handleUpdate');
                                saveBTN.removeAttr('disabled', 'disabled');
                                transferBTN.removeAttr('disabled', 'disabled');
                                Err = 1;
                            }
                        }
                        else
                        {
                            // baraye bimar ehda shode name coordinator vared nashode ast
                            dangerAlert.text('نام کوردیناتور نمی تواند خالی باشد.');
                            loading.hide();
                            dangerAlert.show();
                            $('#editPatientModal').modal('handleUpdate');
                            saveBTN.removeAttr('disabled', 'disabled');
                            transferBTN.removeAttr('disabled', 'disabled');
                            Err = 1;
                        }
                    }
                    else if(cbPatientStatus.val() == 10 || cbPatientStatus.val() == 11 || cbPatientStatus.val() == 12 || cbPatientStatus.val() == 13 || cbPatientStatus.val() == 14 || cbPatientStatus.val() == 15 || cbPatientStatus.val() == 9 || cbPatientStatus.val() == 23 || cbPatientStatus.val() == 3)
                    {
                        // baresi bimari ke vazeete an fot shode entekhab shode
                        if(cbTol.val() == 1) // agar marge maghzi bashad
                        {
                            if(pcal1.val().length > 6 && pcal3.val().length > 6 && pcal6.val().length > 6)
                            {
                                // tarikhe haye marboot be bimar fot shode sahih ast
                                if(inputSecondGCS.val() == 3 && cbBreathing.val() == 'N' && cbCornea.val() == 'N' && cbPupil.val() == 'N' && cbFaceMove.val() == 'N' &&
                                    cbBodyMove.val() == 'N' && cbDoll.val() == 'N' && cbGag.val() == 'N' && cbCough.val() == 'N')
                                {
                                    Err = 0;
                                    inputBreathingDetail.val('');
                                    inputFaceMovementDetail.val('');
                                    inputBodyMovementDetail.val('');
                                }
                                else
                                {
                                    // bimare daraye reflex va GCS gheyre 3 nemitavanad dar list GCS3 marg maghzi gharar girad
                                    dangerAlert.text('بیمار با GCS بالاتر از 3 و دارای رفلکس نمی تواند در لیست بیماران GCS3 مرگ مغزی قرار گیرد.');
                                    loading.hide();
                                    dangerAlert.show();
                                    $('#editPatientModal').modal('handleUpdate');
                                    saveBTN.removeAttr('disabled', 'disabled');
                                    transferBTN.removeAttr('disabled', 'disabled');
                                    Err = 1;
                                }

                            }
                            else
                            {
                                // tarikh haye marboot be bimare fot shode sahih nemibashad
                                dangerAlert.text('تاریخ بستری، تاریخ شناسایی مرگ مغزی و تاریخ مرگ قلبی را وارد نمائید.');
                                loading.hide();
                                dangerAlert.show();
                                $('#editPatientModal').modal('handleUpdate');
                                saveBTN.removeAttr('disabled', 'disabled');
                                transferBTN.removeAttr('disabled', 'disabled');
                                Err = 1;
                            }
                        }
                        else // agar marge maghzi nabashad
                        {
                            if(pcal1.val().length > 6 && pcal6.val().length > 6)
                            {
                                // tarikhe haye marboot be bimar fot shode sahih ast
                                Err = 0;

                            }
                            else
                            {
                                // tarikh haye marboot be bimare fot shode sahih nemibashad
                                dangerAlert.text('تاریخ بستری و تاریخ مرگ قلبی بیمار را وارد نمائید.');
                                loading.hide();
                                dangerAlert.show();
                                $('#editPatientModal').modal('handleUpdate');
                                saveBTN.removeAttr('disabled', 'disabled');
                                transferBTN.removeAttr('disabled', 'disabled');
                                Err = 1;
                            }
                        }
                    }
                }
                else
                {
                    // azmayeshat va vazeeate paydari mariz be dorosti takmil nashode
                    dangerAlert.text('اطلاعات مربوط به قسمت آزمایشات و وضعیت پایداری بیمار را تکمیل نمائید.');
                    loading.hide();
                    dangerAlert.show();
                    changeHeightModal('editPatientModal');
                    saveBTN.removeAttr('disabled', 'disabled');
                    transferBTN.removeAttr('disabled', 'disabled');
                    Err = 1;
                }
            }
            else if(cbPatientStatus.val() == 5) // agar vazeeate bimar montaghel shode entekhab shod form enteghal namayesh dade mishavad
            {
                saveBTN.hide();
                transferBTN.hide();
                insertState('cbTransferState', false);
                form.hide();
                transferForm.show();
                transferSaveBTN.show();
                $('#editPatientModal').modal('handleUpdate');
                loading.hide();
                exp--;
            }
            else if(cbPatientStatus.val() == 0) // agar hich vazeeate baraye bimar zakhire nashod
            {
                // vazeeate bimar entekhab nashode ast
                dangerAlert.text('لطفاً وضعیت بیمار را انتخاب نمائید.');
                loading.hide();
                dangerAlert.show();
                $('#editPatientModal').modal('handleUpdate');
                saveBTN.removeAttr('disabled', 'disabled');
                transferBTN.removeAttr('disabled', 'disabled');
                Err = 1;
            }
            else
            {
                Err = 1;
            }
            
            // ersal etela'at tabaghe bandi shode be server
            if((chUn.is(':checked') || (inputFullName.val().length > 5 && inputAge.val().length > 0)) &&
                inputFirstGCS.val().length > 0 && cbDoc.val() > 0 && cbHospitals.val() > 0 && cbSection.val() > 0 &&
                cbPresentioan.val() > 0 && cbTol.val() > 0 && inputSecondGCS.val() >= 3 && inputSecondGCS.val() <= 15 && pcal1.val().length > 6)
            {
                if(Err == 0)
                {
                    if(exp > 0)
                    {
                        $.ajax({
                        type: "POST",
                        url: base_url() + "ajax/ajax_conf/edit_patient_data",
                        cache: false,
                        data : $('#editPatientForms').serialize()
                        }).done(function(Data){
                            if(Data == 'OK')
                            {
                                successAlert.text('اطلاعات مورد نظر با موفقیت ثبت گردید.');
                                loading.hide();
                                saveBTN.removeAttr('disabled', 'disabled');
                                transferBTN.removeAttr('disabled', 'disabled');
                                successAlert.show();
                                changeHeightModal('editPatientModal');
                                setTimeout(function(){
                                   window.location.reload(1);
                                }, 5000);
                            }
                            else if(Data == 'Err')
                            {
                                dangerAlert.text('خطایی در ثبت اطلاعات رخ داده است.');
                                loading.hide();
                                saveBTN.removeAttr('disabled', 'disabled');
                                transferBTN.removeAttr('disabled', 'disabled');
                                dangerAlert.show();
                                changeHeightModal('editPatientModal');
                            }
                        });
                        exp--;
                    }
                }
            }
            else
            {
                // form not valid
                //alert(Err);
                dangerAlert.text('لطفاً گزینه های ستاره دار را به درستی وارد نمائید.');
                loading.hide();
                dangerAlert.show();
                changeHeightModal('editPatientModal');
                saveBTN.removeAttr('disabled', 'disabled');
                transferBTN.removeAttr('disabled', 'disabled');
            }
        });
    }
    $('#cbDoc').on('change', function(){
        changeDoc();
    });
    $('#cbTol').on('change', function(){
        insertDocOption('cbPatientStatusEdit', 'cbTol', false, 'ALL');
    });
    $('#chisUnknown').on('change', function(){
        if($('#chisUnknown').is(':checked'))
        {
            $('#inputFullName').attr('disabled', 'disabled');
            $('#inputNationalCode').attr('disabled', 'disabled');
            $('#inputAge').attr('disabled', 'disabled');
        }
        else
        {
            $('#inputFullName').removeAttr('disabled', 'disabled');
            $('#inputNationalCode').removeAttr('disabled', 'disabled');
            $('#inputAge').removeAttr('disabled', 'disabled');
        }
    });
    $('#cbPatientStatusEdit').on('change', function(){
        if($('#cbPatientStatusEdit').val() == 22)
        {
            $('#inputPatientStatusDetail').show();
        }
        else
        {
            $('#inputPatientStatusDetail').hide();
        }
    });
}

// view patient log
function viewPatientLog(id)
{
    if(id > 0)
    {
        $('#patientLogDiv').hide();
        $('#viewPatientLogModalLoading').show();
        $('#patientLogDiv').hide();
        $('#patientTestDiv').hide();
        $('#patientConditionDiv').hide();
        $('#patientOrgansDiv').hide();
        var j = 1;
        if(j > 0)
        {
            $.ajax({
                dataType: "json",
                type: "POST",
                url: base_url() + "ajax/ajax_conf/load_one_patient_log",
                cache: false,
                data: {pID: id}
                }).done(function(Data){
                    // result
                    if(Data.isData > 0)
                    {
                        if(Data.isLog > 0)
                        {
                            var tabbleLog;
                            for(var i = 0, a = 1; i < Data.countLog; i++)
                            {
                                if(Data.log[i].patientStatus)
                                {
                                    var color = Data.log[i].patientStatus.color ? Data.log[i].patientStatus.color : '';
                                    var color2 = Data.log[i].patientStatus.res1 ? Data.log[i].patientStatus.res1 : '';
                                    var tolName = Data.log[i].patientStatus.name ? Data.log[i].patientStatus.name : '-';
                                }
                                else
                                {
                                    var color = '';
                                    var color2 = '';
                                    var tolName = '-';
                                }
                                tabbleLog += '<tr style="background-color: ' + color + ';color: ' + color2 + '">';
                                tabbleLog += '<td style="width: 50px;">' + a + '</td>';
                                tabbleLog += '<td style="width: 250px;">OPU: <span style="font-family: ' + "'webYekan'" + '; font-size: 12px;">' + Data.log[i].opu + '</span>';
                                tabbleLog += '<br>استان: <span style="font-family: ' + "'webYekan'" + '; font-size: 12px;">' +  Data.log[i].state + '</span>';
                                tabbleLog += '<br>شهر: <span style="font-family: ' + "'webYekan'" + '; font-size: 12px;">' + Data.log[i].city + '</span>';
                                tabbleLog += '<br> نام بیمارستان: <span style="font-family: ' + "'webYekan'" + '; font-size: 12px;">' + Data.log[i].hospital + '</span>';
                                tabbleLog += '<br>بخش: <span style="font-family: ' + "'webYekan'" + '; font-size: 12px;">';
                                if(Data.log[i].section == 1)
                                {
                                    tabbleLog += 'ICU';
                                }
                                else if(Data.log[i].section == 2)
                                {
                                    tabbleLog += 'CCU';
                                }
                                else if(Data.log[i].section == 3)
                                {
                                    tabbleLog += 'اورژانس';
                                }
                                else if(Data.log[i].section == 4)
                                {
                                    tabbleLog += 'بخش';
                                }
                                if(Data.log[i].typeOfSection && Data.log[i].typeOfSection.length > 0)
                                {
                                    tabbleLog += ' - ' + Data.log[i].typeOfSection;
                                }
                                
                                tabbleLog += '</span></td>';

                                var tol = Data.log[i].tol ? Data.log[i].tol : '-';
                                var statusDetail = Data.log[i].patientStatusDetail ? Data.log[i].patientStatusDetail : '-';

                                tabbleLog += '<td style="width: 150px;">لیست: <span style="font-family: ' + "'webYekan'" + '; font-size: 12px;">' + tol + '</span>';
                                tabbleLog += '<br>وضعیت: <span style="font-family: ' + "'webYekan'" + '; font-size: 12px;">' + tolName + '</span>';
                                tabbleLog += '<br>توضیحات: <span style="font-family: ' + "'webYekan'" + '; font-size: 12px;">' + statusDetail + '</span></td>';
                                tabbleLog += '<td style="width: 150px; text-align: center"><span style="font-family: ' + "'webYekan'" + '; font-size: 12px;">' + Data.log[i].inspector + '</span></td>';
                                tabbleLog += '<td style="width: 100px; text-align: center"><span style="font-family: ' + "'webYekan'" + '; font-size: 12px;">';
                                
                                if(Data.log[i].secondGCS > 0) 
                                {
                                    tabbleLog += Data.log[i].secondGCS;
                                }
                                else
                                {
                                    tabbleLog += '-';
                                }
                                
                                tabbleLog += '</span></td>';
                                tabbleLog += '<td style="width: 300px; text-align: left; font-family: Tahoma; font-size: 14px;"><table style="width: 100%; direction: ltr; font-size: 12px;"><tbody><tr><td style="width: 62%; text-align: left; border-right: 1px dashed;">Breathing: <span style="font-weight: bold;">' + Data.log[i].breathing;
                                
                                if(Data.log[i].breathingDetail.length > 0)
                                {
                                    tabbleLog += ' - ' + Data.log[i].breathingDetail;
                                }
                                
                                tabbleLog += '</span></td><td style="width: 38%; text-align: left; padding-left: 5px;">Gag: <span style="font-weight: bold;">' + Data.log[i].gag + '</span></td></tr><tr><td style="width: 62%; text-align: left; border-right: 1px dashed;">Doll\'s Eyes: <span style="font-weight: bold;">' + Data.log[i].dollEye + '</span></td><td style="width: 38%; text-align: left; padding-left: 5px;">Cough: <span style="font-weight: bold;">' + Data.log[i].cough + '</span></td></tr><tr><td style="width: 62%; text-align: left; border-right: 1px dashed;">Body Movement: <span style="font-weight: bold;">' + Data.log[i].bodyMovement;
                                
                                if(Data.log[i].bodyMovementDetail.length > 1)
                                {
                                    tabbleLog += ' - ' + Data.log[i].bodyMovementDetail;
                                }
                                
                                tabbleLog += '</span></td><td style="width: 38%; text-align: left; padding-left: 5px;">Pupil: <span style="font-weight: bold;">' + Data.log[i].pupil + '</span></td></tr><tr><td style="width: 62%; text-align: left; border-right: 1px dashed;">Face Movement: <span style="font-weight: bold;">' + Data.log[i].faceMovement;
                                
                                if(Data.log[i].faceMovementDetail.length > 1)
                                {
                                    tabbleLog += ' - ' + Data.log[i].faceMovementDetail;
                                }
                                
                                tabbleLog += '</span></td><td style="width: 38%; text-align: left; padding-left: 5px;">Cornea: <span style="font-weight: bold;">' + Data.log[i].cornea + '</span></td></tr><tr><td style="width: 62%; text-align: left; border-right: 1px dashed;">Sedation: <span style="font-weight: bold;">' + Data.log[i].sedation + '</span><td style="width: 38%; text-align: left;"></td></tr></tbody></table></td><td style="width: 100px; text-align: center;">' + Data.log[i].lastUpdateTime + '</td></tr>';
                                
                                a++;
                                
                            }
                            
                            $('#tableLogContent').html(tabbleLog);
                            $('#patientLogDiv').show();
                            changeHeightModal('viewPatientLogModal');
                        }
                        
                        if(Data.isTest > 0)
                        {
                            var tableTest;
                            var tableCondition;
                            for(var i = 0, a = 1; i < Data.countTest; i++)
                            {
                                var na = Data.test[i].na ? Data.test[i].na : '-';
                                var k = Data.test[i].k ? Data.test[i].k : '-';
                                var bun = Data.test[i].bun ? Data.test[i].bun : '-';
                                var urea = Data.test[i].urea ? Data.test[i].urea : '-';
                                var ca = Data.test[i].ca ? Data.test[i].ca : '-';
                                var cr = Data.test[i].cr ? Data.test[i].cr : '-';
                                var alt = Data.test[i].alt ? Data.test[i].alt : '-';
                                var ast = Data.test[i].ast ? Data.test[i].ast : '-';
                                var wbc = Data.test[i].wbc ? Data.test[i].wbc : '-';
                                var plt = Data.test[i].plt ? Data.test[i].plt : '-';
                                var hb = Data.test[i].hb ? Data.test[i].hb : '-';
                                var bs = Data.test[i].bs ? Data.test[i].bs : '-';
                                tableTest += '<tr style="text-align: left;"><td style="width: 50px; text-align: center; font-family: ' + "'BNazanin'" + '; font-size: 14px;">' + a + '</td>';
                                tableTest += '<td style="width: 80px;">' + na + '</td>';
                                tableTest += '<td style="width: 80px;">' + k + '</td>';
                                tableTest += '<td style="width: 80px;">' + bun + '</td>';
                                tableTest += '<td style="width: 80px;">' + urea + '</td>';
                                tableTest += '<td style="width: 80px;">' + ca + '</td>';
                                tableTest += '<td style="width: 80px;">' + cr + '</td>';
                                tableTest += '<td style="width: 80px;">' + alt + '</td>';
                                tableTest += '<td style="width: 80px;">' + ast + '</td>';
                                tableTest += '<td style="width: 80px;">' + wbc + '</td>';
                                tableTest += '<td style="width: 80px;">' + plt + '</td>';
                                tableTest += '<td style="width: 80px;">' + hb + '</td>';
                                tableTest += '<td style="width: 80px;">' + bs + '</td>';
                                tableTest += '</tr>';

                                var t = Data.test[i].t ? Data.test[i].t : '-';
                                var b = Data.test[i].b ? Data.test[i].b : '-';
                                var p = Data.test[i].p ? Data.test[i].p : '-';
                                var pr = Data.test[i].pr ? Data.test[i].pr : '-';
                                var rr = Data.test[i].rr ? Data.test[i].rr : '-';
                                var fio2 = Data.test[i].fio2 ? Data.test[i].fio2 : '-';
                                var o2sat = Data.test[i].o2sat ? Data.test[i].o2sat : '-';
                                var out = Data.test[i].out ? Data.test[i].out : '-';
                                var sedation = Data.test[i].sedation ? Data.test[i].sedation : '-';

                                tableCondition += '<tr style="text-align: left;"><td style="width: 51px; text-align: center; font-family: ' + "'BNazanin'" + '; font-size: 14px;">' + a + '</td>';
                                tableCondition += '<td style="width: 111px;">' + t + '</td>';
                                tableCondition += '<td style="width: 111px;">' + b + '.' + p + '</td>';
                                tableCondition += '<td style="width: 111px;">' + pr + '</td>';
                                tableCondition += '<td style="width: 111px;">' + rr + '</td>';
                                tableCondition += '<td style="width: 111px;">' + fio2 + '</td>';
                                tableCondition += '<td style="width: 111px;">' + o2sat + '</td>';
                                tableCondition += '<td style="width: 111px;">' + out + '</td>';
                                tableCondition += '<td style="width: 111px;">' + sedation + '</td>';
                                tableCondition += '</tr>';

                                a++;
                            }
                            
                            $('#tableTestContent').html(tableTest);
                            $('#patientTestDiv').show();
                            $('#viewPatientLogModal').modal('handleUpdate');

                            $('#tableConditionContent').html(tableCondition);
                            $('#patientConditionDiv').show();
                        }
                        
                        if(Data.isOrgan > 0)
                        {
                            var yes = '<span class="glyphicon glyphicon-ok" style="color: green; font-size: 16px;"></span>';
                            var no = '<span class="glyphicon glyphicon-remove" style="color: red; font-size: 16px;"></span>';
                            if(Data.organ.heart == 1)
                            {
                                $('#patientOrganHeart').html(yes);
                            }
                            else
                            {
                                $('#patientOrganHeart').html(no);
                            }
                            if(Data.organ.liver == 1)
                            {
                                $('#patientOrganLiver').html(yes);
                            }
                            else
                            {
                                $('#patientOrganLiver').html(no);
                            }
                            if(Data.organ.kidneyRight == 1)
                            {
                                $('#patientOrganRight').html(yes);
                            }
                            else
                            {
                                $('#patientOrganRight').html(no);
                            
                            }
                            if(Data.organ.kidneyLeft == 1)
                            {
                                $('#patientOrganLeft').html(yes);
                            }
                            else
                            {
                                $('#patientOrganLeft').html(no);
                            }
                            if(Data.organ.lungRight == 1)
                            {
                                $('#patientOrganLungRight').html(yes);
                            }
                            else
                            {
                                $('#patientOrganLungRight').html(no);
                            }
                            if(Data.organ.lungLeft == 1)
                            {
                                $('#patientOrganLungLeft').html(yes);
                            }
                            else
                            {
                                $('#patientOrganLungLeft').html(no);
                            }
                            if(Data.organ.pancreas == 1)
                            {
                                $('#patientOrganPanc').html(yes);
                            }
                            else
                            {
                                $('#patientOrganPanc').html(no);
                            }
                            if(Data.organ.tissue == 1)
                            {
                                $('#patientOrganTiss').html(yes);
                            }
                            else
                            {
                                $('#patientOrganTiss').html(no);
                            }
                            if(Data.organ.bowel == 1)
                            {
                                $('#patientOrganBowel').html(yes);
                            }
                            else
                            {
                                $('#patientOrganBowel').html(no);
                            }
                            
                            $('#patientOrgansDiv').show();
                            changeHeightModal();
                        }
                        
                        
                        $('#viewPatientLogModalLoading').hide();
                            changeHeightModal('viewPatientLogModal');
                    }
                });
                j--;
        }
    }
}

// delete patient
function deletePatient(id)
{
    if(id > 0)
    {
        var name = $('#patientName' + id).text();
        var inactiveDeleteBTN = $('#DeleteBTN');
        var saveLoading = $('#deleteModalLoading');
        var divQes = $('#activeQuestion');
        var danger2 = $('#dangerAlertStatus2');
        var danger3 = $('#dangerAlertStatus3');
        inactiveDeleteBTN.removeAttr('disabled', 'disabled');
        saveLoading.hide();
        danger2.hide();
        danger3.hide();
                
        divQes.html('آیا مایل به حذف بیمار، <span style="font-weight: bold; color: #2B689B;">' + name + '</span> می‌باشید؟');
        divQes.show();
        
        inactiveDeleteBTN.unbind('click').bind('click', function(){
            inactiveDeleteBTN.attr('disabled', 'disabled');
            saveLoading.show();
            var j = 1;
            if(j > 0)
            {
                $.ajax({
                type: "POST",
                url: base_url() + "ajax/ajax_conf/change_patient_status",
                cache: false,
                data: {pID: id}
                }).done(function(Data){
                    inactiveDeleteBTN.removeAttr('disabled', 'disabled');
                    saveLoading.hide();
                    if(Data == 1)
                    {
                        danger3.show();
                        setTimeout(function(){
                               window.location.reload(1);
                            }, 5000);
                    }
                    else if(Data == 2)
                    {
                        danger2.show();
                    }
                });
                j--;
            }
        });
    }
}

// undo delete patient
function undoDeletePatient(id)
{
    if(id > 0)
    {
        var name = $('#patientName' + id).text();
        var inactiveDeleteBTN = $('#undoDeleteBTN');
        var saveLoading = $('#undoDeleteModalLoading');
        var divQes = $('#undoActiveQuestion');
        var danger2 = $('#undoDangerAlertStatus2');
        var danger3 = $('#undoDangerAlertStatus3');
        inactiveDeleteBTN.removeAttr('disabled', 'disabled');
        saveLoading.hide();
        danger2.hide();
        danger3.hide();
                
        divQes.html('آیا مایل به بازگرداندن بیمار، <span style="font-weight: bold; color: #2B689B;">' + name + '</span> می‌باشید؟');
        divQes.show();
        
        inactiveDeleteBTN.unbind('click').bind('click', function(){
            inactiveDeleteBTN.attr('disabled', 'disabled');
            saveLoading.show();
            var j = 1;
            if(j > 0)
            {
                $.ajax({
                type: "POST",
                url: base_url() + "ajax/ajax_conf/change_undo_patient_status",
                cache: false,
                data: {pID: id}
                }).done(function(Data){
                    inactiveDeleteBTN.removeAttr('disabled', 'disabled');
                    saveLoading.hide();
                    if(Data == 1)
                    {
                        danger3.show();
                        setTimeout(function(){
                               window.location.reload(1);
                            }, 5000);
                    }
                    else if(Data == 2)
                    {
                        danger2.show();
                    }
                });
                j--;
            }
        });
    }
}

// verify or unverify transfer patient
function verifyTransferPatient(id, status)
{
    if(id > 0)
    {
        var name = $('#patientName' + id).text();
        var inactiveDeleteBTN = $('#transferAPatientModalBTN');
        var saveLoading = $('#transferAPatientModalLoading');
        var divQes = $('#transferAPatientModalActiveQuestion');
        var danger1 = $('#transferAPatientModalDanger1');
        var danger2 = $('#transferAPatientModalDanger2');
        inactiveDeleteBTN.removeAttr('disabled', 'disabled');
        saveLoading.hide();
        danger1.hide();
        danger2.hide();
                
        if(status == 'verify')
        {
            var x = 'آیا انتقال بیمار <span style="font-weight: bold; color: #2B689B;">' + name + '</span> را به مرکز فراهم آوری جدید تایید می نمائید؟';
        }
        else if(status == 'unVerify')
        {
            var x = 'آیا مایل به انصراف انتقال بیمار  <span style="font-weight: bold; color: #2B689B;">' + name + '</span> هستید؟';
        }
        
        divQes.html(x);
        divQes.show();
        
        inactiveDeleteBTN.unbind('click').bind('click', function(){
            inactiveDeleteBTN.attr('disabled', 'disabled');
            saveLoading.show();
            var j = 1;
            if(j > 0)
            {
                $.ajax({
                type: "POST",
                url: base_url() + "ajax/ajax_conf/verify_patient_transfer",
                cache: false,
                data: {pID: id, pStatus: status}
                }).done(function(Data){
                    inactiveDeleteBTN.removeAttr('disabled', 'disabled');
                    saveLoading.hide();
                    if(Data == 1)
                    {
                        danger2.show();
                        setTimeout(function(){
                               window.location.reload(1);
                            }, 5000);
                    }
                    else if(Data == 2)
                    {
                        danger1.show();
                    }
                });
                j--;
            }
        });
    }
}

// delete hospital
function deleteHospital(id)
{
    if(id > 0)
    {
        var name = $('#hospialName' + id).text();
        var inactiveDeleteBTN = $('#deleteHospitalModalBTN');
        var saveLoading = $('#deleteHospitalModalLoading');
        var divQes = $('#deleteHospitalModalActiveQuestion');
        var danger1 = $('#deleteHospitalModalDanger1');
        var danger2 = $('#deleteHospitalModalDanger3');
        inactiveDeleteBTN.removeAttr('disabled', 'disabled');
        saveLoading.hide();
        danger1.hide();
        danger2.hide();
        var i = 1;
                
        var x = 'آیا مایل به حذف بیمارستان <span style="font-weight: bold; color: #2B689B;">' + name + '</span> می باشید؟';
        
        divQes.html(x);
        divQes.show();
        
        inactiveDeleteBTN.unbind('click').bind('click', function(){
            inactiveDeleteBTN.attr('disabled', 'disabled');
            saveLoading.show();
            if(i > 0)
            {
                $.ajax({
                type: "POST",
                url: base_url() + "ajax/ajax_conf/delete_one_hospital",
                cache: false,
                data: {hID: id}
                }).done(function(Data){
                    inactiveDeleteBTN.removeAttr('disabled', 'disabled');
                    saveLoading.hide();
                    if(Data == 1)
                    {
                        danger2.show();
                        setTimeout(function(){
                               window.location.reload(1);
                            }, 2500);
                    }
                    else if(Data == 2)
                    {
                        danger1.show();
                    }
                });
                i--;
            }
        });
    }
}

// run archive patient process
function archivePatientRun()
{
    var btn = $('#saveArchiveBTN');
    var opu = $('#cbOpuArchive');
    var status = $('#cbPStatusArchive');
    var fromDate = $('#fromDateArchive');
    var toDate = $('#toDateArchive');
    var loadding = $('#archiveModalLoading');
    var danger1 = $('#dangerAlert1');
    danger1.hide();
    btn.removeAttr('disabled', 'disabled');
    
    if(opu.val() > 0 && fromDate.val().length > 6 && toDate.val().length > 6)
    {
        btn.attr('disabled', 'disabled');
        loadding.show();
    }
    else
    {
        danger1.show();
    }
}

// check the user in loged in
function checkUserLogedIn()
{
    var i = 1;
    if(i > 0)
    {
        $.ajax({
        type: "POST",
        url: base_url() + "ajax/ajax_conf/check_ajax_loged_in",
        cache: false,
        data: {_var: i}
        }).done(function(Data){
            if(Data == 'YES')
            {
                // user is loged in
            }
            else
            {
                window.location = base_url() + 'userAuthentication/user_authentication';
            }
        });
        i--;
    }
}

// show panel
function showPanel(id, status)
{
    if(status == 'p')
    {
        $('#' + id + 'Body').slideToggle();
        $('#' + id + 'Plus').hide();
        $('#' + id + 'Minus').show();
        
    }
    else if(status == 'm')
    {
        $('#' + id + 'Body').slideToggle();
        $('#' + id + 'Plus').show();
        $('#' + id + 'Minus').hide();
    }
    else if(status == 'r')
    {
        $('#' + id).hide(1000);
    }
}

// edit state
function editOneState(id)
{
    $('#modalLoading').hide();
    $('#saveBTN').removeAttr('disabled', 'disabled');
    $('#inputStateName').removeAttr('disabled', 'disabled');
    $('#successAlert').hide();
    $('#dangerAlert').hide();
    $('#dangerAlertTwo').hide();
    var city = $('#cityName' + id).text();
    $('#inputStateName').val(city);
    $('#editStatesForm').show();
    var j = 1;
    
    $('#saveBTN').unbind('click').bind('click', function(){
        $('#modalLoading').show();
        $('#saveBTN').attr('disabled', 'disabled');
        $('#inputStateName').attr('disabled', 'disabled');
        var changeCity = $('#inputStateName').val();
        if(changeCity.length > 1)
        {
            if(j > 0)
            {
                $.ajax({
                type: "POST",
                url: base_url() + "ajax/ajax_conf/edit_state",
                cache: false,
                data: {cityName: changeCity, cityId: id}
                }).done(function(Data){
                    if(Data == '1')
                    {
                        $('#modalLoading').hide();
                        $('#saveBTN').removeAttr('disabled', 'disabled');
                        $('#inputStateName').removeAttr('disabled', 'disabled');
                        $('#successAlert').show();
                        $('#cityName' + id).text(changeCity);
                    }
                    else
                    {
                        $('#modalLoading').hide();
                        $('#saveBTN').removeAttr('disabled', 'disabled');
                        $('#inputStateName').removeAttr('disabled', 'disabled');
                        $('#dangerAlert').show();
                    }
                });
                j--;
            }
        }
        else
        {
            $('#saveBTN').removeAttr('disabled', 'disabled');
            $('#inputStateName').removeAttr('disabled', 'disabled');
            $('#modalLoading').hide();
            $('#dangerAlertTwo').show();
        }
    });
    
    
    
}

// add state
function addState(id)
{
    var load = $('#addStateModalLoading');
    var form = $('#addStateModalForm');
    var city = $('#addStaticCity');
    var stateName = $('#inputNewStateName');
    var btn = $('#addSaveBTN');
    var alert1 = $('#addSuccessAlert');
    var alert2 = $('#addDangerAlert');
    var j = 1;
    load.hide();
    form.show();
    stateName.val();
    alert1.hide();
    alert2.hide();
    if(id > 0)
    {
        $('#inputStateNameStatic').val($('#cityName' + id).text());
        city.show();
    }
    else
    {
        city.hide();
    }
    btn.unbind('click').bind('click', function(){
        if(stateName.val().length > 1 && j > 0)
        {
            btn.attr('disabled', 'disabled');
            form.hide();
            load.show();
            $.ajax({
                    type: "POST",
                    url: base_url() + "ajax/ajax_conf/add_state",
                    cache: false,
                    data: {pId: id, stName: stateName.val()}
                    }).done(function(Data){
                        btn.removeAttr('disabled', 'disabled');
                        load.hide();
                        stateName.val();
                        form.show();
                        if(Data == '1')
                        {
                            alert1.show();
                            setTimeout(function(){
                                   window.location.reload(1);
                                }, 2500);
                        }
                        else
                        {
                            alert2.show();
                        }
                    });
            j--;
        }
    });
}

// redirect page
function redirect(url)
{
    window.location = base_url() + url;
}

// statistics and information
function statistics()
{
    var form = $('#statisticsInformationForm');
    var load = $('#ajaxLoad');
    var ddata = $('#ajaxData');
    load.show();
    ddata.hide();
    var j = 1;
    if(j > 0)
    {
        $.ajax({
            dataType: "json",
            type: "POST",
            url: base_url() + "ajax/ajax_conf/statistics_and_information",
            cache: false,
            data: form.serialize()
        }).done(function(Data){
            load.hide();
            ddata.show();
            if(Data.status == 1)
            {
                $("#stNumber").text(Data.data.number);
                $("#stHeart").text(Data.data.heart);
                $("#stLungRight").text(Data.data.lungRight);
                $("#stLungLeft").text(Data.data.lungLeft);
                $("#stKidneyRight").text(Data.data.kidneyRight);
                $("#stKidneyLeft").text(Data.data.kidneyLeft);
                $("#stLiver").text(Data.data.liver);
                $("#stPancreas").text(Data.data.pancreas);
                $("#stBowel").text(Data.data.bowel);
                $("#stTissue").text(Data.data.tissue);
            }
        });
        j--;
    }
}