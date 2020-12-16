@extends('global.main')

@section('title', "Children's Profile")

@section('page-css')

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{asset('assets/plugins/jquery-smart-wizard/src/css/smart_wizard.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/parsley/src/parsley.css')}}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

@endsection

@section('page-js')


<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{asset('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{asset('assets/js/demo/table-manage-default.demo.min.js')}}"></script>
{{--Modals--}}
<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->

<script src="{{asset('assets/plugins/highlight/highlight.common.js')}}"></script>
<script src="{{asset('assets/js/demo/render.highlight.js')}}"></script>

<script>  
  $(document).ready(function() {
    App.init();
    Notification.init();
    $('#data-table-default-1').DataTable();

    $(".editProfile").click(function()
        {
            //NAME & ID
            $("#childName").text($(this).closest("tbody tr").find("td:eq(1)").html());
            $("#childID").val($(this).closest("tbody tr").find("td:eq(0)").html());

            //CHILDREN'S PROFILE
            var isRegistered = $(this).closest("tbody tr").find("td:eq(4)").html();
                if (isRegistered == 1){ 
                    $('#ecssIsregisteredYes').prop("checked", true); 
                } 
                else {
                    $('#ecssIsregisteredNo').prop("checked", true); 
                }

            var bornAt = $(this).closest("tbody tr").find("td:eq(5)").html();
                if (bornAt == "Hospital"){ 
                    $('#echospital').prop("checked", true);
                } 
                else if (bornAt == "Health Center"){ 
                    $('#echservices').prop("checked", true);
                }
                else { 
                    $('#echome').prop("checked", true); 
                }

            var motherTongue = $(this).closest("tbody tr").find("td:eq(6)").html();
            var otherDialect = $(this).closest("tbody tr").find("td:eq(55)").html();
                if (motherTongue == "Tagalog"){ 
                    $('#ectagalog').prop("checked", true); 
                }
                else if (motherTongue == "Visayan"){ 
                    $('#ecvisayan').prop("checked", true); 
                }
                else if (motherTongue == "Iloco"){ 
                    $('#ecilogo').prop("checked", true); 
                }
                else if (motherTongue == "Bicolnon"){ 
                    $('#ecbicolnon').prop("checked", true); 
                }
                else {
                    $('#ecm_others').text(otherDialect); 
                    $('#ectagalog').prop("checked", false);
                    $('#ecvisayan').prop("checked", false);
                    $('#ecilogo').prop("checked", false);
                    $('#ecbicolnon').prop("checked", false);
                }

            var hasECCD = $(this).closest("tbody tr").find("td:eq(7)").html();
                if (hasECCD == 1){
                    $('#ececcd').prop("checked", true); 
                }
                else {
                    $('#ececcd').prop("checked", false); 
                }

            var hasMCBook = $(this).closest("tbody tr").find("td:eq(8)").html();
                if (hasMCBook == 1){
                    $('#ecmcbook').prop("checked", true); 
                }
                else {
                    $('#ecmcbook').prop("checked", false);
                }

            $('#ecddothers').text($(this).closest("tbody tr").find("td:eq(9)").html());
            $('#echeight').val($(this).closest("tbody tr").find("td:eq(10)").html());
            $('#ecweights').val($(this).closest("tbody tr").find("td:eq(11)").html());
            $('#ecbrthorder').val($(this).closest("tbody tr").find("td:eq(2)").html());

            //VACCINATION AND OTHER HEALTH DATA
            var hasBCG = $(this).closest("tbody tr").find("td:eq(12)").html();
                if (hasBCG == "Yes"){
                    $('#hasBCG').prop("checked", true); 
                }
                else if (hasBCG == "No"){
                    $('#hasNoBCG').prop("checked", true); 
                }
                else {
                    $('#dontKnowBCG').prop("checked", true); 
                }

            var hasDPT = $(this).closest("tbody tr").find("td:eq(13)").html();
                if (hasDPT == "Yes"){
                    $('#hasDPT').prop("checked", true); 
                }
                else if (hasDPT == "No"){
                    $('#hasNoDPT').prop("checked", true); 
                }
                else {
                    $('#dontKnowDPT').prop("checked", true); 
                }

            var oralPolio = $(this).closest("tbody tr").find("td:eq(14)").html();
                if (oralPolio == "Yes"){
                    $('#oralPolio').prop("checked", true); 
                }
                else if (oralPolio == "No"){
                    $('#noOralPolio').prop("checked", true); 
                }
                else {
                    $('#dontKnowOralPolio').prop("checked", true); 
                }

            var hepaB = $(this).closest("tbody tr").find("td:eq(15)").html();
                if (hepaB == "Yes"){
                    $('#hepaB').prop("checked", true); 
                }
                else if (oralPolio == "No"){
                    $('#noHepaB').prop("checked", true); 
                }
                else {
                    $('#dontKnowHepaB').prop("checked", true); 
                }

            var measles = $(this).closest("tbody tr").find("td:eq(16)").html();
                if (hepaB == "Yes"){
                    $('#hasMeasles').prop("checked", true); 
                }
                else if (oralPolio == "No"){
                    $('#hasNoMeasles').prop("checked", true); 
                }
                else {
                    $('#dontKnowMeasles').prop("checked", true); 
                }

            $('#ecmeaslesthers').val($(this).closest("tbody tr").find("td:eq(17)").html());

            //PHYSICAL ATTRIBUTES DATA
            var hareLip = $(this).closest("tbody tr").find("td:eq(18)").html();
                if (hareLip == 1){
                    $('#echlip').prop("checked", true); 
                }
                else {
                    $('#echlip').prop("checked", false); 
                }
                
            var disabledLeg = $(this).closest("tbody tr").find("td:eq(19)").html();
                if (disabledLeg == 1){
                    $('#ecdleg').prop("checked", true); 
                }
                else {
                    $('#ecdleg').prop("checked", false); 
                }

            var disabledArm = $(this).closest("tbody tr").find("td:eq(21)").html();
                if (disabledArm == 1){
                    $('#ecdarm').prop("checked", true); 
                }
                else {
                    $('#ecdarm').prop("checked", false); 
                }

            var crossEyed = $(this).closest("tbody tr").find("td:eq(20)").html();
                if (crossEyed == 1){
                    $('#ecrossseyed').prop("checked", true); 
                }
                else {
                    $('#ecrossseyed').prop("checked", false); 
                }

            var deaf = $(this).closest("tbody tr").find("td:eq(22)").html();
                if (deaf == 1){
                    $('#ecdeaf').prop("checked", true); 
                }
                else {
                    $('#ecdeaf').prop("checked", false); 
                }

            var blind = $(this).closest("tbody tr").find("td:eq(23)").html();
                if (blind == 1){
                    $('#ecblind').prop("checked", true); 
                }
                else {
                    $('#ecblind').prop("checked", false); 
                }

            var deformedFingers = $(this).closest("tbody tr").find("td:eq(24)").html();
                if (deformedFingers == 1){
                    $('#ecftoes').prop("checked", true); 
                }
                else {
                    $('#ecftoes').prop("checked", false); 
                }

            var behavior = $(this).closest("tbody tr").find("td:eq(25)").html();
                if (deformedFingers == 1){
                    $('#ecbehavior').prop("checked", true); 
                }
                else {
                    $('#ecbehavior').prop("checked", false); 
                }

            var speaking = $(this).closest("tbody tr").find("td:eq(26)").html();
                if (speaking == 1){
                    $('#ecspeaking').prop("checked", true); 
                }
                else {
                    $('#ecspeaking').prop("checked", false); 
                }

            var hearing = $(this).closest("tbody tr").find("td:eq(27)").html();
                if (hearing == 1){
                    $('#echearing').prop("checked", true); 
                }
                else {
                    $('#echearing').prop("checked", false); 
                }

            var vision = $(this).closest("tbody tr").find("td:eq(28)").html();
                if (vision == 1){
                    $('#ecvision').prop("checked", true); 
                }
                else {
                    $('#ecvision').prop("checked", false); 
                }

            var isLeftHanded = $(this).closest("tbody tr").find("td:eq(29)").html();
                if (isLeftHanded == 1){
                    $('#eclyes').prop("checked", true); 
                }
                else {
                    $('#eclno').prop("checked", false); 
                }

            //PRIOR EARLY CHILDHOOD EXPERIENCE ITEM
            var nursery = $(this).closest("tbody tr").find("td:eq(30)").html();
                if (nursery == 1){
                    $('#ecnursery').prop("checked", true); 
                }
                else {
                    $('#ecnursery').prop("checked", false); 
                }

            var kinder = $(this).closest("tbody tr").find("td:eq(31)").html();
                if (kinder == 1){
                    $('#eckinder').prop("checked", true); 
                }
                else {
                    $('#eckinder').prop("checked", false); 
                }

            var prep = $(this).closest("tbody tr").find("td:eq(32)").html();
                if (prep == 1){
                    $('#ecprepa').prop("checked", true); 
                }
                else {
                    $('#ecprepa').prop("checked", false); 
                }

            var learnsAt = $(this).closest("tbody tr").find("td:eq(33)").html();
                if (learnsAt == "Public Pre-School"){
                    $('#elpre').prop("checked", true); 
                }
                else if (learnsAt == "Private Day Care"){
                    $('#elprivate').prop("checked", true); 
                }
                else if (learnsAt == "Public Day Care"){
                    $('#elpublic').prop("checked", true); 
                }
                else if (learnsAt == "Church-Based"){
                    $('#elchurch').prop("checked", true); 
                }
                else if (learnsAt == "Home-Based"){
                    $('#elhomeb').prop("checked", true); 
                }
                else if (learnsAt == "Private Pre-School"){
                    $('#elprivatepre').prop("checked", true); 
                }
                else {
                    $('#el_others').text(learnsAt);
                    $('#elpre').prop("checked", false); 
                    $('#elprivate').prop("checked", false);
                    $('#elpublic').prop("checked", false);
                    $('#elchurch').prop("checked", false); 
                    $('#elhomeb').prop("checked", false); 
                    $('#elprivatepre').prop("checked", false); 
                }

            //OTHER PERFORMANCE RELATED INPUTS
            var parents = $(this).closest("tbody tr").find("td:eq(34)").html();
                if (parents == 1){
                    $('#ecmfboth').prop("checked", true); 
                }
                else {
                    $('#ecmfboth').prop("checked", false); 
                }

            var nobody = $(this).closest("tbody tr").find("td:eq(35)").html();
                if (nobody == 1){
                    $('#ecnbody').prop("checked", true); 
                }
                else {
                    $('#ecnbody').prop("checked", false); 
                }

            var siblings = $(this).closest("tbody tr").find("td:eq(36)").html();
                if (siblings == 1){
                    $('#ecsiblings').prop("checked", true); 
                }
                else {
                    $('#ecsiblings').prop("checked", false); 
                }

            var relatives = $(this).closest("tbody tr").find("td:eq(37)").html();
                if (relatives == 1){
                    $('#ecrela').prop("checked", true); 
                }
                else {
                    $('#ecrela').prop("checked", false); 
                }

            var maid = $(this).closest("tbody tr").find("td:eq(38)").html();
                if (maid == 1){
                    $('#ecmaid').prop("checked", true); 
                }
                else {
                    $('#ecmaid').prop("checked", false); 
                }

            var tutor = $(this).closest("tbody tr").find("td:eq(39)").html();
                if (tutor == 1){
                    $('#ectutor').prop("checked", true); 
                }
                else {
                    $('#ectutor').prop("checked", false); 
                }

            $('#ecperfri').text($(this).closest("tbody tr").find("td:eq(40)").html());

            var olderSib = $(this).closest("tbody tr").find("td:eq(41)").html();
                if (olderSib == 1){
                    $('#ep_older').prop("checked", true); 
                }
                else {
                    $('#ep_older').prop("checked", false); 
                }

            var youngerSib = $(this).closest("tbody tr").find("td:eq(42)").html();
                if (youngerSib == 1){
                    $('#ep_younger').prop("checked", true); 
                }
                else {
                    $('#ep_younger').prop("checked", false); 
                }

            var sameAge = $(this).closest("tbody tr").find("td:eq(43)").html();
                if (sameAge == 1){
                    $('#ep_age').prop("checked", true); 
                }
                else {
                    $('#ep_age').prop("checked", false); 
                }

            //LOGISTICS
            $('#ectdcc').val($(this).closest("tbody tr").find("td:eq(44)").html());
            $('#ecmdcc').val($(this).closest("tbody tr").find("td:eq(45)").html());
            $('#etncdc').val($(this).closest("tbody tr").find("td:eq(46)").html());
            $('#ecmncdc').val($(this).closest("tbody tr").find("td:eq(47)").html());
            $('#ecpublic').val($(this).closest("tbody tr").find("td:eq(48)").html());
            $('#ectransfare').val($(this).closest("tbody tr").find("td:eq(49)").html());
            $('#ecgowith').val($(this).closest("tbody tr").find("td:eq(50)").html());
            $('#ecdevteacher').val($(this).closest("tbody tr").find("td:eq(51)").html());

            var doesEatMeal = $(this).closest("tbody tr").find("td:eq(52)").html();
                if (doesEatMeal == "Always"){
                    $('#ee_always').prop("checked", true); 
                }
                else if (doesEatMeal == "Most of the time"){
                    $('#ee_most').prop("checked", true); 
                }
                else if (doesEatMeal == "Sometimes"){
                    $('#ee_sometimes').prop("checked", true); 
                }
                else if (doesEatMeal == "Rarely"){
                    $('#ee_rarely').prop("checked", true); 
                }
                else {
                    $('#ee_never').prop("checked", true); 
                }

            var hasBaon = $(this).closest("tbody tr").find("td:eq(53)").html();
                if (hasBaon == "Money"){
                    $('#ecmoney').prop("checked", true); 
                }
                else if (hasBaon == "Food"){
                    $('#ecfood').prop("checked", true); 
                }
                else if (hasBaon == "Both"){
                    $('#ecboth').prop("checked", true); 
                }
                else if (hasBaon == "None"){
                    $('#ecnone').prop("checked", true); 
                }
                else {
                    $('#echdontknow').prop("checked", true); 
                }

            var normallyEaten = $(this).closest("tbody tr").find("td:eq(54)").html();
                if (normallyEaten == "Vegetable"){
                    $('#ecveggy').prop("checked", true); 
                }
                else if (normallyEaten == "Rice"){
                    $('#ecrice').prop("checked", true); 
                }
                else if (normallyEaten == "Cereals"){
                    $('#eccereal').prop("checked", true); 
                }
                else if (normallyEaten == "Pork"){
                    $('#ecpork').prop("checked", true); 
                }
                else if (normallyEaten == "Noodle"){
                    $('#ecnoodle').prop("checked", true); 
                }
                else if (normallyEaten == "Fruit Juice"){
                    $('#ecfruitjuice').prop("checked", true); 
                }
                else if (normallyEaten == "Chicken"){
                    $('#ecchicken').prop("checked", true); 
                }
                else if (normallyEaten == "Soup"){
                    $('#ecsoup').prop("checked", true); 
                }
                else if (normallyEaten == "Milk"){
                    $('#ecmilk').prop("checked", true); 
                }
                else if (normallyEaten == "Beef"){
                    $('#ecbeef').prop("checked", true); 
                }
                else if (normallyEaten == "Bread"){
                    $('#ecbread').prop("checked", true); 
                }
                else if (normallyEaten == "Fish"){
                    $('#ecfish').prop("checked", true); 
                }
                else {
                    $('#ecfruits').prop("checked", true); 
                }
        });
  });


</script>


<script type="text/javascript">

 var table = $("#data-table-default").DataTable({
  serverSide: true,
  processing: true,    
  ajax:"{{ route('LoadChildren') }}",

  columns:
  [  
  { data: "RESIDENT_ID", name: "RESIDENT_ID", visible: false, searchable: false},
  { data: "FULLNAME", name: "FULLNAME"},
  { data: "SEX", name: "SEX"},

  {render:function(data, type, full, meta) {
      
    return "<button type='button' class='btn btn-success  add_profile_btn'  onClick=\"GoToTab('" + full.FULLNAME+"',"+ full.RESIDENT_ID+")\"  ><i class='fa fa-plus'></i> Add Profile</button>";

  }, searchable: false}, 
  ]
});

</script>

<script type="text/javascript">
  function GoToTab(name,id){

    $("#pill3_btn").click();
  }
  
  $('#edit-btn').click(function () {
    alert($('#resident_id').val())
    //Accordion #1
    var resident_id = $('#resident_id').val();
    var isregistered =  $('input:radio[name=cisregistered]:checked').val();
    var bornat =  $('input:radio[name=cbornat]:checked').val();
    
    var height = $('#cheight').val();
    var weight = $('#cweights').val();
    var brtorder = $('#cbrthorder').val();
    var mtongue = $('input:radio[name=cmtongue]:checked').val();
    var m_others = $('#cm_others').val();
    var ceccd, cmcbook;
    var cddothers = $('#cddothers').val();
   
    if ($("#ceccd").is(":checked")){ ceccd = 1; } else if ($("#ceccd").is(":not(:checked)")) { ceccd = 0; }
    if ($("#cmcbook").is(":checked")){ cmcbook = 1; } else if ($("#cmcbook").is(":not(:checked)")) { cmcbook = 0; }

    //Accordion #2
    
    var cbcg = $('input:radio[name=cbcg]:checked').val();
    var cdpt = $('input:radio[name=cdpt]:checked').val();
    var cpolio = $('input:radio[name=cpolio]:checked').val();
    var chepab = $('input:radio[name=chepab]:checked').val();
    var cmeasles = $('input:radio[name=cmeasles]:checked').val();
    var cmeaslesthers = $('#cmeaslesthers').val();
   



    //Accordion #3 
    var chlip, cdleg, cdarm, crossseyed, cdeaf, cftoes, cbehavior, cspeaking, chearing, cvision, cblind;
    var clefthanded = $('input:radio[name=clefthanded]:checked').val();
  
    if ($("#chlip").is(":checked")){ chlip = 1; } else if ($("#chlip").is(":not(:checked)")) { chlip = 0; }
    if ($("#cdleg").is(":checked")){ cdleg = 1; } else if ($("#cdleg").is(":not(:checked)")) { cdleg = 0; }
    if ($("#cdarm").is(":checked")){ cdarm = 1; } else if ($("#cdarm").is(":not(:checked)")) { cdarm = 0; }
    if ($("#crossseyed").is(":checked")){ crossseyed = 1; } else if ($("#crossseyed").is(":not(:checked)")) { crossseyed = 0; }
    if ($("#cdeaf").is(":checked")){ cdeaf = 1; } else if ($("#cdeaf").is(":not(:checked)")) { cdeaf = 0; }
    if ($("#cblind").is(":checked")){ cblind = 1; } else if ($("#cblind").is(":not(:checked)")) { cblind = 0; }
    if ($("#cftoes").is(":checked")){ cftoes = 1; } else if ($("#cftoes").is(":not(:checked)")) { cftoes = 0; }
    if ($("#cbehavior").is(":checked")){ cbehavior = 1; } else if ($("#cbehavior").is(":not(:checked)")) { cbehavior = 0; }
    if ($("#cspeaking").is(":checked")){ cspeaking = 1; } else if ($("#cspeaking").is(":not(:checked)")) { cspeaking = 0; }
    if ($("#chearing").is(":checked")){ chearing = 1; } else if ($("#chearing").is(":not(:checked)")) { chearing = 0; }
    if ($("#cvision").is(":checked")){ cvision = 1; } else if ($("#cvision").is(":not(:checked)")) { cvision = 0; }

   

    //Accordion #4
    var cnursery, ckinder, cprepa;
    var clearsat = $('input:radio[name=clearsat]:checked').val();
    var l_others = $('#l_others').val();


    if ($("#cnursery").is(":checked")){ cnursery = 1; } else if ($("#cnursery").is(":not(:checked)")) { cnursery = 0; }
    if ($("#ckinder").is(":checked")){ ckinder = 1; } else if ($("#ckinder").is(":not(:checked)")) { ckinder = 0; }
    if ($("#cprepa").is(":checked")){ cprepa = 1; } else if ($("#cprepa").is(":not(:checked)")) { cprepa = 0; }

    var cnbody, cmfboth, csiblings, crela, cmaid, ctutor, p_older, p_younger, p_age;
    if ($("#cnbody").is(":checked")){ cnbody = 1; } else if ($("#cnbody").is(":not(:checked)")) { cnbody = 0; }
    if ($("#cmfboth").is(":checked")){ cmfboth = 1; } else if ($("#cmfboth").is(":not(:checked)")) { cmfboth = 0; }
    if ($("#csiblings").is(":checked")){ csiblings = 1; } else if ($("#csiblings").is(":not(:checked)")) { csiblings = 0; }
    if ($("#crela").is(":checked")){ crela = 1; } else if ($("#crela").is(":not(:checked)")) { crela = 0; }
    if ($("#cmaid").is(":checked")){ cmaid = 1; } else if ($("#cmaid").is(":not(:checked)")) { cmaid = 0; }
    if ($("#ctutor").is(":checked")){ ctutor = 1; } else if ($("#ctutor").is(":not(:checked)")) { ctutor = 0; }
    if ($("#p_older").is(":checked")){ p_older = 1; } else if ($("#p_older").is(":not(:checked)")) { p_older = 0; }
    if ($("#p_younger").is(":checked")){ p_younger = 1; } else if ($("#p_younger").is(":not(:checked)")) { p_younger = 0; }
    if ($("#p_age").is(":checked")){ p_age = 1; } else if ($("#p_age").is(":not(:checked)")) { p_age = 0; }


     // Accordion #6
    var cmoney,cfood,cboth,cnone,chdontknow,cveggy,crice,ccereal,cpork,cnoodle,cfruitjuice,cchicken,csoup,cmilk,cbeef,cbread,cfish,cfruits;

    var ctdcc = $('#ctdcc').val();
    var cmdcc = $('#cmdcc').val();
    var tncdc = $('#tncdc').val();
    var cmncdc = $('#cmncdc').val();
    var cpublic = $('#cpublic').val();
    var ctransfare = $('#ctransfare').val();
    var cgowith = $('#cgowith').val();
    var cdevteacher = $('#cdevteacher').val();
    var ceatsmeals = $('input:radio[name=ceatsmeals]:checked').val();
    var cfoodeaten = $('input:radio[name=cfoodeaten]:checked').val();
    var chasbaon = $('input:radio[name=chasbaon]:checked').val();
    
    var fd = new FormData();
          // Accordion #1
    fd.append('resident_id', resident_id);
    fd.append('brtorder', brtorder);
    fd.append('isregistered', isregistered);
    fd.append('bornat', bornat);
    fd.append('mtongue', mtongue);
    fd.append('m_others', m_others);
    fd.append('height', height);
    fd.append('weight', weight );


    fd.append('ceccd', ceccd);
    fd.append('cmcbook', cmcbook);
    fd.append('cddothers', cddothers);

    // Accordion #2

    fd.append('cbcg', cbcg);
    fd.append('cdpt', cdpt);
    fd.append('cpolio', cpolio);
    fd.append('chepab', chepab);
    fd.append('cmeasles', cmeasles);
    fd.append('cmeaslesthers', cmeaslesthers);


    // Accordion #3
    fd.append('chlip', chlip);
    fd.append('cdleg', cdleg);
    fd.append('cdarm', cdarm);
    fd.append('crossseyed', crossseyed);
    fd.append('cdeaf', cdeaf);
    fd.append('cblind', cblind);
    fd.append('cftoes', cftoes);
    fd.append('cbehavior', cbehavior);
    fd.append('cspeaking', cspeaking);
    fd.append('chearing', chearing);
    fd.append('cvision', cvision);

     // Accordion #4
    fd.append('clefthanded', clefthanded);

    fd.append('cnursery', cnursery);
    fd.append('ckinder', ckinder);
    fd.append('cprepa', cprepa);

    fd.append('clearsat', clearsat);
    fd.append('l_others', l_others);
   

     // Accordion #5
   
    fd.append('cmfboth', cmfboth);
    fd.append('cnbody', cnbody);
    fd.append('csiblings', csiblings);
    fd.append('crela', crela);
    fd.append('cmaid', cmaid);
    fd.append('ctutor', ctutor);
    fd.append('p_older', p_older);
    fd.append('p_younger', p_younger);
    fd.append('p_age', p_age);

    //Accordion #6
    fd.append('ceatsmeals', ceatsmeals);
    fd.append('chasbaon', chasbaon);
    fd.append('cfoodeaten', cfoodeaten)
    fd.append('ctdcc', ctdcc);
    fd.append('cmdcc', cmdcc);
    fd.append('tncdc', tncdc);
    fd.append('cmncdc', cmncdc);
    fd.append('cpublic', cpublic);
    fd.append('ctransfare', ctransfare);
    fd.append('cgowith', cgowith);
    fd.append('cdevteacher', cdevteacher);
   
  
    
    fd.append('_token',"{{ csrf_token() }}");
    
    Add(fd);

  });

  async function Add(fd) {
    swal("Data have been successfully Added!", {
      icon: "success",
    });

    let result;
  //   try
  //   {
  //      result = await $.ajax({
  //      url:"{{route('ChildrensProfileAdd')}}",
  //      type:'post',
  //      processData:false,
  //      contentType:false,
  //      cache:false,
  //      data:fd,
  //      success:function(data)
  //      {
  //       if (data == "good" )
  //       {
  //         location.reload();
  //       } 
  //     }   
  //   })
  //   }
  //   catch(error)
  //   {
  //     console.error(error);
  //   }
  }


//UPDATING CHILD INFO
$('#updateBTN').click(function () {

    //CHILD'S PROFILE
    var child_id = $('#childID').val();
    var isregistered =  $('input:radio[name=ecisregistered]:checked').val();
    var bornat =  $('input:radio[name=ecbornat]:checked').val();    
    var height = $('#echeight').val();
    var weight = $('#ecweights').val();
    var brtorder = $('#ecbrthorder').val();
    var mtongue = $('input:radio[name=ecmtongue]:checked').val();
    var m_others = $('#ecm_others').val();
    var ceccd, cmcbook;
    if ($("#ececcd").is(":checked")){ ceccd = 1; } else if ($("#ececcd").is(":not(:checked)")) { ceccd = 0; }
    if ($("#ecmcbook").is(":checked")){ cmcbook = 1; } else if ($("#ecmcbook").is(":not(:checked)")) { cmcbook = 0; }
    var cddothers = $('#ecddothers').val();
    

    //VACCINATION
    var cbcg = $('input:radio[name=ecbcg]:checked').val();
    var cdpt = $('input:radio[name=ecdpt]:checked').val();
    var cpolio = $('input:radio[name=ecpolio]:checked').val();
    var chepab = $('input:radio[name=echepab]:checked').val();
    var cmeasles = $('input:radio[name=ecmeasles]:checked').val();
    var cmeaslesthers = $('#ecmeaslesthers').val();


    //PHYSICAL ATTRIBUTES
    var chlip, cdleg, cdarm, crossseyed, cdeaf, cftoes, cbehavior, cspeaking, chearing, cvision, cblind;
    var clefthanded = $('input:radio[name=eclefthanded]:checked').val();
  
    if ($("#echlip").is(":checked")){ chlip = 1; } else if ($("#echlip").is(":not(:checked)")) { chlip = 0; }
    if ($("#ecdleg").is(":checked")){ cdleg = 1; } else if ($("#ecdleg").is(":not(:checked)")) { cdleg = 0; }
    if ($("#ecdarm").is(":checked")){ cdarm = 1; } else if ($("#ecdarm").is(":not(:checked)")) { cdarm = 0; }
    if ($("#ecrossseyed").is(":checked")){ crossseyed = 1; } else if ($("#ecrossseyed").is(":not(:checked)")) { crossseyed = 0; }
    if ($("#ecdeaf").is(":checked")){ cdeaf = 1; } else if ($("#ecdeaf").is(":not(:checked)")) { cdeaf = 0; }
    if ($("#ecblind").is(":checked")){ cblind = 1; } else if ($("#ecblind").is(":not(:checked)")) { cblind = 0; }
    if ($("#ecftoes").is(":checked")){ cftoes = 1; } else if ($("#ecftoes").is(":not(:checked)")) { cftoes = 0; }
    if ($("#ecbehavior").is(":checked")){ cbehavior = 1; } else if ($("#ecbehavior").is(":not(:checked)")) { cbehavior = 0; }
    if ($("#ecspeaking").is(":checked")){ cspeaking = 1; } else if ($("#ecspeaking").is(":not(:checked)")) { cspeaking = 0; }
    if ($("#echearing").is(":checked")){ chearing = 1; } else if ($("#echearing").is(":not(:checked)")) { chearing = 0; }
    if ($("#ecvision").is(":checked")){ cvision = 1; } else if ($("#ecvision").is(":not(:checked)")) { cvision = 0; }

   

    //EARLY CHILDHOOD EXPERIENCE
    var cnursery, ckinder, cprepa;
    var clearsat = $('input:radio[name=eclearsat]:checked').val();
    var l_others = $('#el_others').val();

    if ($("#ecnursery").is(":checked")){ cnursery = 1; } else if ($("#ecnursery").is(":not(:checked)")) { cnursery = 0; }
    if ($("#eckinder").is(":checked")){ ckinder = 1; } else if ($("#eckinder").is(":not(:checked)")) { ckinder = 0; }
    if ($("#ecprepa").is(":checked")){ cprepa = 1; } else if ($("#ecprepa").is(":not(:checked)")) { cprepa = 0; }

    // PERFORMANCE RELATED INPUTS
    var cnbody, cmfboth, csiblings, crela, cmaid, ctutor, p_older, p_younger, p_age;
    if ($("#ecnbody").is(":checked")){ cnbody = 1; } else if ($("#cnbody").is(":not(:checked)")) { cnbody = 0; }
    if ($("#ecmfboth").is(":checked")){ cmfboth = 1; } else if ($("#cmfboth").is(":not(:checked)")) { cmfboth = 0; }
    if ($("#ecsiblings").is(":checked")){ csiblings = 1; } else if ($("#csiblings").is(":not(:checked)")) { csiblings = 0; }
    if ($("#ecrela").is(":checked")){ crela = 1; } else if ($("#ecrela").is(":not(:checked)")) { crela = 0; }
    if ($("#ecmaid").is(":checked")){ cmaid = 1; } else if ($("#ecmaid").is(":not(:checked)")) { cmaid = 0; }
    if ($("#ectutor").is(":checked")){ ctutor = 1; } else if ($("#ectutor").is(":not(:checked)")) { ctutor = 0; }
    if ($("#ep_older").is(":checked")){ p_older = 1; } else if ($("#ep_older").is(":not(:checked)")) { p_older = 0; }
    if ($("#ep_younger").is(":checked")){ p_younger = 1; } else if ($("#ep_younger").is(":not(:checked)")) { p_younger = 0; }
    if ($("#ep_age").is(":checked")){ p_age = 1; } else if ($("#ep_age").is(":not(:checked)")) { p_age = 0; }


    // LOGISTICS
    var cmoney,cfood,cboth,cnone,chdontknow,cveggy,crice,ccereal,cpork,cnoodle,cfruitjuice,cchicken,csoup,cmilk,cbeef,cbread,cfish,cfruits;

    var ctdcc = $('#ectdcc').val();
    var cmdcc = $('#ecmdcc').val();
    var tncdc = $('#etncdc').val();
    var cmncdc = $('#ecmncdc').val();
    var cpublic = $('#ecpublic').val();
    var ctransfare = $('#ectransfare').val();
    var cgowith = $('#ecgowith').val();
    var cdevteacher = $('#ecdevteacher').val();
    var ceatsmeals = $('input:radio[name=eceatsmeals]:checked').val();
    var cfoodeaten = $('input:radio[name=ecfoodeaten]:checked').val();
    var chasbaon = $('input:radio[name=echasbaon]:checked').val();
    
    var fd = new FormData();
    // CHILD'S PROFILE
    fd.append('child_id', child_id);
    fd.append('brtorder', brtorder);
    fd.append('isregistered', isregistered);
    fd.append('bornat', bornat);
    fd.append('mtongue', mtongue);
    fd.append('m_others', m_others);
    fd.append('height', height);
    fd.append('weight', weight );
    fd.append('ceccd', ceccd);
    fd.append('cmcbook', cmcbook);
    fd.append('cddothers', cddothers);

    // VACCINATION

    fd.append('cbcg', cbcg);
    fd.append('cdpt', cdpt);
    fd.append('cpolio', cpolio);
    fd.append('chepab', chepab);
    fd.append('cmeasles', cmeasles);
    fd.append('cmeaslesthers', cmeaslesthers);


    // PHYSICAL ATTRIBUTES
    fd.append('chlip', chlip);
    fd.append('cdleg', cdleg);
    fd.append('cdarm', cdarm);
    fd.append('crossseyed', crossseyed);
    fd.append('cdeaf', cdeaf);
    fd.append('cblind', cblind);
    fd.append('cftoes', cftoes);
    fd.append('cbehavior', cbehavior);
    fd.append('cspeaking', cspeaking);
    fd.append('chearing', chearing);
    fd.append('cvision', cvision);

    // EARLYCHILDHOOD EXPERIENCE
    fd.append('clefthanded', clefthanded);
    fd.append('cnursery', cnursery);
    fd.append('ckinder', ckinder);
    fd.append('cprepa', cprepa);
    fd.append('clearsat', clearsat);
    fd.append('l_others', l_others);
   

    //OTHER PERFORMANCE INPUTS
    fd.append('cmfboth', cmfboth);
    fd.append('cnbody', cnbody);
    fd.append('csiblings', csiblings);
    fd.append('crela', crela);
    fd.append('cmaid', cmaid);
    fd.append('ctutor', ctutor);
    fd.append('p_older', p_older);
    fd.append('p_younger', p_younger);
    fd.append('p_age', p_age);

    //LOGISTICS
    fd.append('ceatsmeals', ceatsmeals);
    fd.append('chasbaon', chasbaon);
    fd.append('cfoodeaten', cfoodeaten)
    fd.append('ctdcc', ctdcc);
    fd.append('cmdcc', cmdcc);
    fd.append('tncdc', tncdc);
    fd.append('cmncdc', cmncdc);
    fd.append('cpublic', cpublic);
    fd.append('ctransfare', ctransfare);
    fd.append('cgowith', cgowith);
    fd.append('cdevteacher', cdevteacher);
   
    fd.append('_token',"{{ csrf_token() }}");
    
    try {
        swal({
            title: "Wait!",
            text: "Are you sure you want to update this?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willResolve) => {
            if (willResolve) {
                swal("Data have been successfully updated!", {
                    icon: "success",
                });
                $.ajax({
                    url:'ChildrensProfileEdit',
                    type:'POST',
                    processData:false,
                    contentType:false,
                    cache:false,
                    data:fd,
                    success:function()
                    {
                       location.reload();
                    }
                })  
            } 
            else {
                swal("Operation Cancelled.", {
                   icon: "error",
                });
            }
        });
    }
    catch(error)
    {
      console.error(error);
    }
});

  
</script>
<script type="text/javascript">

 $("#data-table-default tbody").on('click', 'tr', function () {


  var fullname = table.cell( this, 1).data();  
  var resident_id = table.cell(this, 0).data();
  $('#resident_id').val(resident_id);
  $("#edit_db_name").text(fullname);
  


  // $('#edit_mother_id').val($(this).closest("tbody tr").find("td:eq(0)").html());
  // $('#editmtongue').val($(this).closest("tbody tr").find("td:eq(5)").html());
  // $('#editmdialect').val($(this).closest("tbody tr").find("td:eq(6)").html());
  // $('#editmeducationatt').val($(this).closest("tbody tr").find("td:eq(7)").html());
  // fd.append('cmoney', cmoney);
    // fd.append('cfood', cfood);
    // fd.append('cboth', cboth);
    // fd.append('cnone', cnone);
    // fd.append('chdontknow', chdontknow);
    // fd.append('cfoodeaten', cfoodeaten);
   // if ($("#cmoney").is(":checked")){ cmoney = 1; } else if ($("#cmoney").is(":not(:checked)")) { cmoney = 0; }
    // if ($("#cfood").is(":checked")){ cfood = 1; } else if ($("#cfood").is(":not(:checked)")) { cfood = 0; }
    // if ($("#cboth").is(":checked")){ cboth = 1; } else if ($("#cboth").is(":not(:checked)")) { cboth = 0; }
    // if ($("#cnone").is(":checked")){ cnone = 1; } else if ($("#cnone").is(":not(:checked)")) { cnone = 0; }
    // if ($("#chdontknow").is(":checked")){ chdontknow = 1; } else if ($("#chdontknow").is(":not(:checked)")) { chdontknow = 0; }
    // if ($("#cveggy").is(":checked")){ cveggy = 1; } else if ($("#cveggy").is(":not(:checked)")) { cveggy = 0; }
    // if ($("#crice").is(":checked")){ crice = 1; } else if ($("#crice").is(":not(:checked)")) { crice = 0; }
    // if ($("#ccereal").is(":checked")){ ccereal = 1; } else if ($("#ccereal").is(":not(:checked)")) { ccereal = 0; }
    // if ($("#cpork").is(":checked")){ cpork = 1; } else if ($("#cpork").is(":not(:checked)")) { cpork = 0; }
    // if ($("#cnoodle").is(":checked")){ cnoodle = 1; } else if ($("#cnoodle").is(":not(:checked)")) { cnoodle = 0; }
    // if ($("#cfruitjuice").is(":checked")){ cfruitjuice = 1; } else if ($("#cfruitjuice").is(":not(:checked)")) { cfruitjuice = 0; }
    // if ($("#cchicken").is(":checked")){ cchicken = 1; } else if ($("#cchicken").is(":not(:checked)")) { cchicken = 0; }
    // if ($("#csoup").is(":checked")){ csoup = 1; } else if ($("#csoup").is(":not(:checked)")) { csoup = 0; }
    // if ($("#cmilk").is(":checked")){ cmilk = 1; } else if ($("#cmilk").is(":not(:checked)")) { cmilk = 0; }
    // if ($("#cbeef").is(":checked")){ cbeef = 1; } else if ($("#cbeef").is(":not(:checked)")) { cbeef = 0; }
    // if ($("#cbread").is(":checked")){ cbread = 1; } else if ($("#cbread").is(":not(:checked)")) { cbread = 0; }
    // if ($("#cfish").is(":checked")){ cfish = 1; } else if ($("#cfish").is(":not(:checked)")) { cfish = 0; }
    // if ($("#cfruits").is(":checked")){ cfruits = 1; } else if ($("#cfruits").is(":not(:checked)")) { cfruits = 0; }
});
</script>
@endsection

@section('content')


<div id="content" class="content">
  <!-- begin breadcrumb -->
  <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Children's Information</a></li>

  </ol>
  <!-- end breadcrumb -->
  <!-- begin page-header -->
  <h1 class="page-header">Basic Information  <small>DILG Requirements</small></h1>
  <!-- end page-header -->

  <!-- begin nav-pills -->
  <ul class="nav nav-pills">
    <li class="nav-items">
      <a href="#nav-pills-tab-1" data-toggle="tab" class="nav-link active">

        <span class="d-sm-block d-none">Records</span>
      </a>
    </li>
    <li class="nav-items">
      <a href="#nav-pills-tab-2" data-toggle="tab" class="nav-link" >

        <span class="d-sm-block d-none">List of Children</span>
      </a>
    </li>

    <li class="nav-items">
      <a href="#nav-pills-tab-3" data-toggle="tab"  id="pill3_btn" class="nav-link" hidden>

        <span class="d-sm-block d-none">List of Children</span>
      </a>
    </li>
     

  </ul>
  <!-- end nav-pills -->
  <!-- begin tab-content -->
  <div class="tab-content">
    <!-- begin tab-pane -->
    <div class="tab-pane fade active show" id="nav-pills-tab-1">
      {{--Nav Pill Body Start--}}
      <!-- begin panel add new -->
      <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

          </div>
          <h4 class="panel-title">Existing Records</h4>
        </div>
        <!-- end panel-heading -->
        <!-- begin alert -->
        <div class="alert alert-yellow fade show">
          <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
          </button>
          The following are the existing records of children within the system.
        </div>
        <!-- end alert -->
        <!-- begin panel-body -->
        <div class="panel-body">

          <table id="data-table-default-1" class="table table-striped table-bordered">
            
            <thead>
              <tr>
                <th hidden>Children ID </th>
                <th>Fullname</th>
                <th>Birth Order</th>
                <th>Birth Place</th>
                {{--CHILDREN'S PROFILE--}}
                <th hidden>Is Registered?</th>
                <th hidden>Born At</th>
                <th hidden>Mother Tongue</th>
                <th hidden>ECCD Card</th>
                <th hidden>Mother & Child Book</th>
                <th hidden>Does it have other</th>
                <th hidden>Height</th>
                <th hidden>Weight</th>
                {{--VACCINATION--}}
                <th hidden>BCG</th>
                <th hidden>DPT</th>
                <th hidden>Polio</th>
                <th hidden>Hepa B</th>
                <th hidden>Measles</th>
                <th hidden>Vaccination Others</th>
                {{--PHYSICAL ATTRIBUTES--}}
                <th hidden>Hare Lip</th>
                <th hidden>Disabled Leg</th>
                <th hidden>Cross-eyed</th>
                <th hidden>Disabled Arm/Hand</th>
                <th hidden>Deaf</th>
                <th hidden>Blind</th>
                <th hidden>Deformity in Finger/Toes</th>
                <th hidden>Behavior</th>
                <th hidden>Speaking</th>
                <th hidden>Hearing</th>
                <th hidden>Vision</th>
                <th hidden>Is Left-handed?></th>
                {{--CHILDHOOD EXP--}}
                <th hidden>Nursery</th>
                <th hidden>Kindergarten</th>
                <th hidden>Preparatory></th>
                <th hidden>Learns at</th>
                {{--PERFORMANCE--}}
                <th hidden>Parents</th>
                <th hidden>Nobody</th>
                <th hidden>Siblings</th>
                <th hidden>Relatives</th>
                <th hidden>Househelp/Maid</th>
                <th hidden>Tutor</th>
                <th hidden>Others</th>
                <th hidden>Older Siblings</th>
                <th hidden>Younger Siblings</th>
                <th hidden>Same Age</th>
                {{--LOGISTICS--}}
                <th hidden>Travel Time DCC</th>
                <th hidden>Mode of Transpo DCC</th>
                <th hidden>Travel Time NCDC</th>
                <th hidden>Mode of Transpo NCDC</th>
                <th hidden>Public Transpo</th>
                <th hidden>Transpo Fare</th>
                <th hidden>Chaperone</th>
                <th hidden>Teacher</th>
                <th hidden>Meals</th>
                <th hidden>Baon</th>
                <th hidden>Food</th> 

                <th hidden>Other Dialect</th>
                <th style="width: 15%">Actions </th>
              </tr>
            </thead>
            <tbody>
            @foreach( $dispChildren as $child )
              <tr>
                  <td hidden>{{$child->CHILDREN_ID}}</td>
                  @if ($child->MIDDLENAME == "")
                  <td>{{$child->LASTNAME}} {{$child->FIRSTNAME}}</td>                                
                  @else
                  <td>{{$child->LASTNAME}} {{$child->FIRSTNAME}} {{$child->MIDDLENAME}}</td>
                  @endif
                  <td>{{$child->BIRTH_ORDER}}</td>
                  <td>{{$child->PLACE_OF_BIRTH}}</td>
                  {{--CHILDREN'S PROFILE--}}
                  <td hidden>{{$child->IS_REGISTERED}}</td>
                  <td hidden>{{$child->BORN_AT}}</td>
                  <td hidden>{{$child->CHILDER_MOTHER_TONGUE}}</td>
                  <td hidden>{{$child->DOES_IT_HAVE_ECCD_CARD}}</td>
                  <td hidden>{{$child->DOES_IT_HAVE_MOTHER_CHILD_BOOK}}</td>
                  <td hidden>{{$child->DOES_IT_HAVE_OTHERS}}</td>
                  <td hidden>{{$child->CHILDREN_HEIGHT}}</td>
                  <td hidden>{{$child->CHILDREN_WEIGHT}}</td>
                  {{--VACCINATION--}}
                  <td hidden>{{$child->VACCINATION_BCG}}</td>
                  <td hidden>{{$child->VACCINATION_DPT}}</td>
                  <td hidden>{{$child->VACCINATION_ORAL_POLIO}}</td>
                  <td hidden>{{$child->VACCINATION_HEPA_B}}</td>
                  <td hidden>{{$child->VACCINATION_MEASLES}}</td>
                  <td hidden>{{$child->VACCINATION_OTHERS}}</td>
                  {{--PHYSICAL ATTRIBUTES--}}
                  <td hidden>{{$child->DEFORMITY_HARE_LIP}}</td>
                  <td hidden>{{$child->DEFORMITY_DISABLE_LEG}}</td>
                  <td hidden>{{$child->DEFORMITY_CROSS_EYED}}</td>
                  <td hidden>{{$child->DEFORMITY_DISABLE_ARM_LEG}}</td>
                  <td hidden>{{$child->DEFORMITY_DEAF}}</td>
                  <td hidden>{{$child->DEFORMITY_BLIND}}</td>
                  <td hidden>{{$child->DEFORMITY_FINGER_TOES}}</td>
                  <td hidden>{{$child->PROBLEMS_WITH_BEHAVIOR}}</td>
                  <td hidden>{{$child->PROBLEMS_WITH_SPEAKING}}</td>
                  <td hidden>{{$child->PROBLEMS_WITH_HEARING}}</td>
                  <td hidden>{{$child->PROBLEMS_WITH_VISION}}</td>
                  <td hidden>{{$child->IS_LEFT_HANDED}}</td>
                  {{--CHILDHOOD EXP--}}
                  <td hidden>{{$child->CHILDHOOD_EXP_NURSERY}}</td>
                  <td hidden>{{$child->CHILDHOOD_EXP_KINDERGARTEN}}</td>
                  <td hidden>{{$child->CHILDHOOD_EXP_PREPARATORY}}</td>
                  <td hidden>{{$child->LEARNS_WHERE}}</td>
                  {{--PERFORMANCE--}}
                  <td hidden>{{$child->LEARNS_AT_HOME_W_PARENTS}}</td>
                  <td hidden>{{$child->LEARNS_AT_HOME_W_NOBODY}}</td>
                  <td hidden>{{$child->LEARNS_AT_HOME_W_SIBLINGS}}</td>
                  <td hidden>{{$child->LEARNS_AT_HOME_W_RELATIVES}}</td>
                  <td hidden>{{$child->LEARNS_AT_HOME_W_MAID}}</td>
                  <td hidden>{{$child->LEARNS_AT_HOME_TUTOR}}</td>
                  <td hidden>{{$child->LEARNS_AT_HOME_W_OTHERS}}</td>
                  <td hidden>{{$child->INTERACTS_W_OLDER_SIBLINGS}}</td>
                  <td hidden>{{$child->INTERACTS_W_YOUNGER_SIBLINGS}}</td>
                  <td hidden>{{$child->INTERACTS_W_SAME_AGE}}</td>
                  {{--LOGISTICS--}}
                  <td hidden>{{$child->TRAVEL_TIME_TO_DCC}}</td>
                  <td hidden>{{$child->MODE_TRANSPORTATION_TO_DCC}}</td>
                  <td hidden>{{$child->TRAVEL_TIME_TO_NCDC}}</td>
                  <td hidden>{{$child->MODE_TRANSPORTATION_TO_NCDC}}</td>
                  <td hidden>{{$child->PUBLIC_TRANSPORTATION_ID}}</td>
                  <td hidden>{{$child->TRANSPORTATION_FARE}}</td>
                  <td hidden>{{$child->GOES_TO_SCHOOL_WITH}}</td>
                  <td hidden>{{$child->CHILD_DEVELOPMENT_TEACHER}}</td>
                  <td hidden>{{$child->EATS_MEAL_BEFORE_SCHOOL}}</td>
                  <td hidden>{{$child->HAS_BAON}}</td>
                  <td hidden>{{$child->FOOD_NORMALLY_EATEN}}</td>

                  <td hidden>{{$child->CHILDREN_OTHER_DIALECT}}</td>
                  <td>
                      <button type='button' class='btn btn-success editProfile' data-toggle='modal' data-target='#UpdateModal' >
                          <i class='fa fa-edit'></i> Edit
                      </button> 
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>  

        </div>
        <!-- end panel-body -->


      </div>
      <!-- end panel add new -->
      {{--Nav Pill Body End--}}
    </div>
     <div class="tab-pane fade" id="nav-pills-tab-3">
      {{--Nav Pill Body Start--}}
      <!-- begin panel add new -->
      <div class="panel panel-inverse">
        <!-- begin panel-heading -->
        <div class="panel-heading">
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

          </div>
          <h4 class="panel-title">Add Profile</h4>
        </div>
        <!-- end panel-heading -->
        <!-- begin alert -->
        <div class="alert alert-yellow fade show">
          <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
          </button>
          Add new profile for children.
        </div>

        <!-- end alert -->
        <!-- begin panel-body -->
        <div class="panel-body">
        <form id="AddForm" class="form-control-with-bg">
          @csrf
           <h><label style="display: block; text-align: center">Residents's Name</label></h>
        <h3><b><label style="text-transform: capitalize; display: block; text-align: center" id="edit_db_name" name="edit_db_name"></label></b></h3>
        <br>
        <input id="resident_id" type="text" hidden="true" />
                    <!-- begin #accordion -->
          <div id="accordion" class="card-accordion">
            <!-- begin card -->
            <div class="card">
              <div class="card-header text-white pointer-cursor"  style="background-color: #7cb5ec" data-toggle="collapse" data-target="#collapseOne">
                 <h><label style="display: block; text-align: center; color: white">Children's Profile</label></h>
              </div>
              <div id="collapseOne" class="collapse show" data-parent="#accordion">
                <div class="card-body">
                 This includes information about the children.
                </div>
                <div class="row">
                 <div class="col-lg-5">
                  <label style="display: block; text-align: left;">&nbsp&nbsp&nbspIs registered?</label>
                  <div class=" col-md-6">
                    <div class="stats-content">

                     <div class="radio radio-css">
                      <input class="form-control" type="radio" name="cisregistered" id="cssIsregisteredYes" value=1 checked />
                      <label for="cssIsregisteredYes">Yes</label>
                      <div class="radio radio-css">
                        <input class="form-control" type="radio" name="cisregistered" id="cssIsregisteredNo" value=0 />
                        <label for="cssIsregisteredNo">No</label>
                      </div><br>
                    </div>
                  </div>
                </div>


              </div>
              <div class="col-lg-5">
                <label style="display: block; text-align: left">&nbsp&nbsp&nbspBorn at</label>
                <div class=" col-md-6">
                  <div class="stats-content">
                   <div class="radio radio-css">
                    <input type="radio" name="cbornat" id="chospital" value="Hospital" checked />
                    <label for="chospital">Hospital</label>
                  </div>
                  <div class="radio radio-css">
                    <input type="radio" name="cbornat" id="chservices" value="Health Center"  />
                    <label for="chservices">Health Center</label>
                  </div>
                  <div class="radio radio-css">
                    <input type="radio" name="cbornat" id="chome" value="Home" />
                    <label for="chome">Home</label>
                  </div><br>

                </div>
              </div>
            </div>   
              
            <div class="col-lg-2">
             <div class=" col-md-10">
              <label for="cheight">Height(cm)</label>
              <input type="number" class="form-control" name="cstats" id="cheight" /><br>

              <label for="cweights">Weight(kg)</label>
              <input type="number" class="form-control"  name="cstats" id="cweights" /><br>
              <label style="display: block; text-align: left">Birth Order</label>
              <div>
                <input class="form-control" type="number" max="15"  min="1" name="cbrthorder" id="cbrthorder" />

              </div> 
            </div>
          </div>
        </div> <br>

        <div class="row">
         <div class="col-lg-5">
          <label style="display: block; text-align: left">&nbsp&nbsp&nbspMother Tongue</label>
          <div class=" col-md-6">
            <div class="stats-content">
             <div class="radio radio-css">
              <input type="radio" name="cmtongue" id="ctagalog" value="Tagalog" />
              <label for="ctagalog">Tagalog</label>
            </div>
            <div class="radio radio-css">
              <input type="radio" name="cmtongue" id="cvisayan" value="Visayan" />
              <label for="cvisayan">Visayan</label>
            </div>
            <div class="radio radio-css">
              <input type="radio" name="cmtongue" id="cilogo" value="Iloco" />
              <label for="cilogo">Iloco</label>
            </div>
            <div class="radio radio-css">
              <input type="radio" name="cmtongue" id="cbicolnon" value="Bicolnon" />
              <label for="cbicolnon">Bicolnon</label>
            </div><br>
            <div >
             <label for="cbicolnon">Others please specify:</label>
             <textarea class="form-control" type="text-area" name="cm_others" id="cm_others"></textarea>

           </div><br>   
         </div>
       </div>
     </div>
     <div class="col-lg-5">
      <label style="display: block; text-align: left">&nbsp&nbsp&nbspDoes the child have:</label>
      <div class=" col-md-6">
        <div class="stats-content">

         <div class="checkbox checkbox-css">
          <input type="checkbox" name="cddchild" id="ceccd" value=1 checked />
          <label for="ceccd">ECCD Card</label>
        </div>
        <div class="checkbox checkbox-css">
          <input type="checkbox" name="cddchild" id="cmcbook" value=0  />
          <label for="cmcbook">Mother & Child book</label>
        </div><br><br><br>
        <div >

          <label for="">Others please specify:</label>
          <textarea class="form-control" type="text-area" name="cddothers" id="cddothers"></textarea>

        </div>
      </div>
    </div>
  </div>   

</div>
  <!-- new row -->

</div>
</div>

<!-- begin card -->
<div class="card">
  <div class="card-header text-white pointer-cursor collapsed" style="background-color: #e89bbf" data-toggle="collapse" data-target="#collapseTwo">
     <h><label style="display: block; text-align: center; color: white">Vaccination and other health data</label></h> 
  </div>
  <div id="collapseTwo" class="collapse" data-parent="#accordion">
    <div class="card-body">
     Vaccination and other data
    </div>
    <div class="row">
     <div class="col-lg-5">
      <label style="display: block; text-align: left;">&nbsp&nbsp&nbsp&nbsp&nbspBCG</label>
      <div class=" col-md-6">
        <div class="stats-content">

         <div class="radio radio-css">
          <input class="form-control" type="radio" name="cbcg" id="cssRadioConcrete" value="Yes" checked />
          <label for="cssRadioConcrete">Yes</label>
          <div class="radio radio-css">
            <input class="form-control" type="radio" name="cbcg" id="cssRadioWood" value="No" />
            <label for="cssRadioWood">No</label>
          </div>
          <div class="radio radio-css">
            <input type="radio" id="cno" name="cbcg" value="Don't know" />
            <label for="cno">Don't know</label>
          </div>
          <br>
        </div>
      </div>
    </div>

    
  </div>
  <div class="col-lg-5">
    <label style="display: block; text-align: left">&nbspDPT</label>
    <div >
      <div class="radio radio-css">

        <input type="radio" id="dyes" name="cdpt" value="Yes" checked />
        <label for="dyes">Yes</label>

      </div>
      <div class="radio radio-css">

        <input type="radio" id="dno" name="cdpt" value="No" />
        <label for="dno">No</label>
      </div>
      <div class="radio radio-css">

        <input type="radio" id="dknow" name="cdpt" value="Don't know" />
        <label for="dknow">Don't know</label>
      </div>
    </div>
  </div>

  <div class="col-lg-2">
    <label style="display: block; text-align: left">&nbspOral Polio</label>
    <div >
      <div class="radio radio-css">

        <input type="radio" id="oyes" name="cpolio" value="Yes" checked />
        <label for="oyes">Yes</label>

      </div>
      <div class="radio radio-css">

        <input type="radio" id="ono" name="cpolio" value="No" />
        <label for="ono">No</label>
      </div>
      <div class="radio radio-css">

        <input type="radio" id="oknow" name="cpolio" value="Don't know" />
        <label for="oknow">Don't know</label>
      </div>
    </div>
  </div>



</div> <br>
<div class="row">
  <div class="col-lg-5">
    <div class=" col-md-6">
      <label style="display: block; text-align: left">&nbspHepa B</label>
      <div >
        <div class="radio radio-css">

          <input type="radio" id="hyes" name="chepab" value="Yes" checked />
          <label for="hyes">Yes</label>

        </div>
        <div class="radio radio-css">

          <input type="radio" id="hno" name="chepab" value="No" />
          <label for="hno">No</label>
        </div>
        <div class="radio radio-css">

          <input type="radio" id="hknow" name="chepab" value="Don't know"/>
          <label for="hknow">Don't know</label>
        </div>
      </div>
    </div>
  </div>
 
  <div class="col-lg-5">

    <label style="display: block; text-align: left">&nbspMeasles</label>
    <div >
      <div class="radio radio-css">

        <input type="radio" id="myes" name="cmeasles" value="Yes" checked />
        <label for="myes">Yes</label>

      </div>
      <div class="radio radio-css">

        <input type="radio" id="mno" name="cmeasles" value="No"/>
        <label for="mno">No</label>
      </div>
      <div class="radio radio-css">

        <input type="radio" id="mknow" name="cmeasles" value="Don't know"/>
        <label for="mknow">Don't know</label>
      </div> <br>
     
    </div>
  </div>
  <div class="col-lg-2">
    <div>
        <label style="display: block; text-align: left">Others</label>
        <textarea class="form-control" id="cmeaslesthers" ></textarea> 

      </div>
  </div>

</div>
</div>
</div>
<!-- end card -->


<!-- begin card -->
<div class="card">
  <div class="card-header text-white pointer-cursor collapsed" style="background-color: #91a5b8" data-toggle="collapse" data-target="#collapseThree">
    <h><label style="display: block; text-align: center; color: white">Physical Attributes data</label></h> 
  </div>
  <div id="collapseThree" class="collapse" data-parent="#accordion">
    <div class="card-body">
     Physical attribute of the children
    </div>
    <div class="row">
      <div class="col-lg-5">
        <div class=" col-md-6">
          <label style="display: block; text-align: left">&nbspPhysical Deformity</label>
          <div >
            <div class="checkbox checkbox-css">

              <input type="checkbox" id="chlip" name="cpdefo" value=1 checked />
              <label for="chlip">Hare Lip</label>
            </div>
            <div class="checkbox checkbox-css">

              <input type="checkbox" id="cdleg" name="cpdefo" value=0 />
              <label for="cdleg">Disabled Leg</label>
            </div>
            <div class="checkbox checkbox-css">

              <input type="checkbox" id="cdarm" name="cpdefo" value=0 />
              <label for="cdarm">Disabled Arm/Hand</label>
            </div>
            <div class="checkbox checkbox-css">

              <input type="checkbox" id="crossseyed" name="cpdefo" value=0 />
              <label for="crossseyed">Cross-Eyed (Duling or Banlag)</label>
            </div>
            <div class="checkbox checkbox-css">

              <input type="checkbox" id="cdeaf" name="cpdefo" value=0 />
              <label for="cdeaf">Deaf</label>
            </div>
             <div class="checkbox checkbox-css">

              <input type="checkbox" id="cblind" name="cpdefo" value=0 />
              <label for="cblind">Blind</label>
            </div>
            <div class="checkbox checkbox-css">

              <input type="checkbox" id="cftoes" name="cpdefo" value=0 />
              <label for="cftoes">Deformity in Fingers/Toes</label>
            </div>
          </div>
          <br>
        </div>
      </div>


      <div class="col-lg-5">

        <label style="display: block; text-align: left">&nbspProblems with</label>
        <div>
          <div class="checkbox checkbox-css">

            <input type="checkbox" id="cbehavior" name="cpwith" value=1 checked />
            <label for="cbehavior">Behavior</label>


          </div>
          <div class="checkbox checkbox-css">

            <input type="checkbox" id="cspeaking" name="cpwith" value=0 />
            <label for="cspeaking">Speaking</label>
          </div>
          <div class="checkbox checkbox-css">

            <input type="checkbox" id="chearing" name="cpwith" value=0 />
            <label for="chearing">Hearing</label>
          </div>
          <div class="checkbox checkbox-css">

            <input type="checkbox" id="cvision" name="cpwith" value=0 />
            <label for="cvision">Vision</label>
          </div>
        </div>

      </div>

      <div class="col-lg-2">

        <label style="display: block; text-align: left">&nbspLeft Handed</label>
        <div>
          <div class="radio radio-css">

            <input type="radio" id="clyes" name="clefthanded" value=1 checked />
            <label for="clyes">Yes</label>

          </div>
          <div class="radio radio-css">

            <input type="radio" id="clno" name="clefthanded" value=0 />
            <label for="clno">No</label>
          </div>
        </div>

      </div>


    </div>
  </div>
</div> 
<!-- end card -->
<!-- begin card -->
<div class="card">
  <div class="card-header text-white pointer-cursor collapsed" style="background-color: #808e9c" data-toggle="collapse" data-target="#collapseFour">
    <h><label style="display: block; text-align: center; color: white">Prior Early Childhood Experience Item</label></h> 
  </div>
  <div id="collapseFour" class="collapse" data-parent="#accordion">
    <div class="card-body">
     Early experience of the children
    </div>
    <div class="row">
      <div class="col-lg-5">
        <div class=" col-md-6">
          <label style="display: block; text-align: left">&nbspChildhood Experience</label>
          <div >
            {{--<div class="radio radio-css">

              <input type="radio" id="csmale" name="csibling" value=1 checked />
              <label for="csmale">Male</label>

            </div>
            <div class="radio radio-css">

              <input type="radio" id="csfemale" name="csibling" value=0 />
              <label for="csfemale">Female</label>
            </div> --}}

            <div>

               <div class="checkbox checkbox-css">
                <input type="checkbox" id="cnursery" name="expi" value=1 checked />
                <label for="cnursery">Nursery</label>
              </div>
               <div class="checkbox checkbox-css">
                <input type="checkbox" id="ckinder" name="expi" value=0 />
                <label for="ckinder">Kindergarten</label>
              </div>
               <div class="checkbox checkbox-css">
                <input type="checkbox" id="cprepa" name="expi" value=0 />
                <label for="cprepa">Preparatory</label>
              </div>
              
            </div>
          </div>
        </div>


      </div>

      <div class="col-lg-5">
       
        <label style="display: block; text-align: left">&nbspLearns at</label>
        <div>
          <div class="radio radio-css">

            <input type="radio" id="lpre" name="clearsat" value="Public Pre-School" />
            <label for="lpre">Public Pre-School</label>
          </div>
          <div class="radio radio-css">

            <input type="radio" id="lprivate" name="clearsat" value="Private Day Care">
            <label for="lprivate">Private Day Care</label>

          </div>
          <div class="radio radio-css">

            <input type="radio" id="lpublic" name="clearsat" value="Public Day Care" />
            <label for="lpublic">Public Day Care</label>
          </div>
          <div class="radio radio-css">

            <input type="radio" id="lchurch" name="clearsat" value="Church-Based"/>
            <label for="lchurch">Church-Based</label>

          </div>
          <div class="radio radio-css">

            <input type="radio" id="lhomeb" name="clearsat" value="Home-Based" />
            <label for="lhomeb">Home-Based</label>
          </div>

          <div class="radio radio-css">

            <input type="radio" id="lprivatepre" name="clearsat" value="Private Pre-School" />
            <label for="lprivatepre">Private Pre-School</label>

          </div>
          <br>
          <label style="display: block; text-align: left">Others</label>
          <div>

            <textarea class="col-lg-4 form-control" id="l_others" ></textarea> 

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header text-white pointer-cursor collapsed" style="background-color: #70e08a" data-toggle="collapse" data-target="#collapseFive">
      <h><label style="display: block; text-align: center; color: white"> Other Performance Related Inputs</label></h>
  </div>
  <div id="collapseFive" class="collapse" data-parent="#accordion">
    <div class="card-body">
      Performance related inputs
    </div>
    <div class="row">
      <div class="col-lg-5">
        <div class=" col-md-6">

          <label style="display: block; text-align: left">&nbspLearns at Home with:</label>
          <div>
            
            <div class="checkbox checkbox-css">
              <input type="checkbox" id="cmfboth" name="clathomewith" value=0  />
              <label for="cmfboth">Mother/Father/Both</label>
            </div>
            <div class="checkbox checkbox-css">
              <!-- cnbody, cmfboth, csiblings, crela, chhelp, ctutor, cperfri -->
              <input type="checkbox" id="cnbody" name="clathomewith" value=1 checked />
              <label for="cnbody">Nobody</label>
            </div>
            <div class="checkbox checkbox-css">

              <input type="checkbox" id="csiblings" name="clathomewith" value=0 />
              <label for="csiblings">Siblings</label>

            </div>
            <div class="checkbox checkbox-css">
              <input type="checkbox" id="crela" name="clathomewith" value=0  />
              <label for="crela">Relatives</label>
            </div>

            <div class="checkbox checkbox-css">

              <input type="checkbox" id="cmaid" name="clathomewith" value=0  />
              <label for="cmaid">Househelp/Maid</label>

            </div>
            <div class="checkbox checkbox-css">

              <input type="checkbox" id="ctutor" name="ctutor" value=0  />
              <label for="ctutor">Tutor</label>

            </div>
            <label style="display: block; text-align: left">&nbspOthers</label>
            <div>

              <textarea class="form-control"id="cperfri" name="clathomewith_txt"></textarea> 

            </div><br>
          </div>
        </div>
      </div>
                
      <div class="col-lg-5">
        <label style="display: block; text-align: left">&nbspPlays Interact with:</label>
        <div>
           <div class="checkbox checkbox-css">

              <input type="checkbox" id="p_older" name="clathomewith" value=1 checked="true" />
              <label for="p_older">Older Siblings</label>

            </div>
             <div class="checkbox checkbox-css">

              <input type="checkbox" id="p_younger" name="clathomewith" value=0 />
              <label for="p_younger">Younger Siblings</label>

            </div>
             <div class="checkbox checkbox-css">

              <input type="checkbox" id="p_age" name="clathomewith" value=0/>
              <label for="p_age">Same Age</label>

            </div>
         
        </div>
      </div>

    </div>
  </div>
</div>
<!-- end card -->
<div class="card">
  <div class="card-header text-white pointer-cursor collapsed" style="background-color: #f07883" data-toggle="collapse" data-target="#collapseSix">
    <h><label style="display: block; text-align: center; color: white">Logistics</label></h>
  </div>
  <div id="collapseSix" class="collapse" data-parent="#accordion">
    <div class="card-body">
     Logistics
    </div>

    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="stats-content">
          <label >&nbspTravel time to DCC<span class="text-danger"></span></label> <span id="lblfirstname"></span>
          <input class="form-control" id="ctdcc" data-parsley-required="true" />

        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="stats-content">
          <label >&nbspMode of transportation to DCC</label><span id="lblmiddlename"></span>

          <input class="form-control" id="cmdcc" data-parsley-required="true" />

        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="stats-content">
          <label >&nbspTravel time to NCDC</label><span id="lbllastname"></span>

          <input class="form-control" id="tncdc" data-parsley-required="true" />

        </div>
      </div>

    </div> <br>
    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="stats-content">
          <label >&nbspMode of transportation to NCDC</label><span id="lblmiddlename"></span>

          <input class="form-control" id="cmncdc" data-parsley-required="true" />

        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="stats-content">
          <label >&nbspPublic Transportation<span class="text-danger"></span></label> <span id="lblfirstname"></span>
          <input class="form-control" id="cpublic" data-parsley-required="true" />

        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="stats-content">
          <label >&nbspTransportation Fare</label><span id="lblmiddlename"></span>

          <input class="form-control" id="ctransfare" data-parsley-required="true" />

        </div>
      </div>
     

    </div> <br>
     <div class="row">
        

       <div class="col-lg-4 col-md-6">
        <div class="stats-content">
          <label >&nbspGoes to school with</label><span id="lbllastname"></span>

          <input class="form-control" id="cgowith" data-parsley-required="true" />

        </div>
      </div>
      

       <div class="col-lg-4 col-md-6">
        <div class="stats-content">
          <label >&nbspChild development teacher</label><span id="lbllastname"></span>

          <input class="form-control" id="cdevteacher" data-parsley-required="true" />

        </div>
      </div>
      
    </div> <br>
    <div class="row">
      <div class="col-lg-5">
        <div class=" col-md-6">
          <label style="display: block; text-align: left">Eats Meal Before Going To School:</label>
          <div>
           <div class="radio radio-css">
            <input type="radio" id="e_always" name="ceatsmeals" value="Always" checked />
            <label for="e_always">Always</label>
          </div>
          <div class="radio radio-css">
            <input type="radio" id="e_most" name="ceatsmeals" value="Most of  the time" />
            <label for="e_most">Most of the time</label>
          </div>
          <div class="radio radio-css">
            <input type="radio" id="e_sometimes" name="ceatsmeals" value="Sometimes" />
            <label for="e_sometimes">Sometimes</label>
          </div>
          <div class="radio radio-css">
            <input type="radio" id="e_rarely" name="ceatsmeals" value="Rarely" />
            <label for="e_rarely">Rarely</label>
          </div>
          <div class="radio radio-css">
            <input type="radio" id="e_never" name="ceatsmeals" value="Never" />
            <label for="e_never">Never</label>
          </div>
          <br>

        </div>
      </div>
    </div>

    <div class="col-lg-5">

    <label style="display: block; text-align: left">&nbspHas Baon:</label>
    <div>
     <div class="radio radio-css">

      <input type="radio" id="cmoney" name="chasbaon" value="Money" />
      <label for="cmoney">Money</label>
    </div>
    <div class="radio radio-css">

      <input type="radio" id="cfood" name="chasbaon" value="Food" />
      <label for="cfood">Food</label>
    </div>

    <div class="radio radio-css">

      <input type="radio" id="cboth" name="chasbaon" value="Both"/>
      <label for="cboth">Both</label>
    </div>

    <div class="radio radio-css">

      <input type="radio" id="cnone" name="chasbaon" value="None" checked />
      <label for="cnone">None</label>
    </div>

    <div class="radio radio-css">

      <input type="radio" id="chdontknow" name="chasbaon" value="Don't know" />
      <label for="chdontknow">Don't Know</label>
    </div>

  </div>

  </div>

    <div class="col-lg-2">
      
      <label style="display: block; text-align: left">&nbspFood Normally Eaten By Child:</label>
      <div>
       <div class="radio radio-css">

        <input type="radio" id="cveggy" name="cfoodeaten" value="Vegetable" checked />
        <label for="cveggy">Vegetable&nbsp&nbsp</label>
      </div>
      <div class="radio radio-css">

        <input type="radio" id="crice" name="cfoodeaten" value="Rice" />
        <label for="crice">Rice&nbsp&nbsp</label>
      </div>
      <div class="radio radio-css">

        <input type="radio" id="ccereal" name="cfoodeaten" value="Cereals" />
        <label for="ccereal">Cereals&nbsp&nbsp&nbsp&nbsp&nbsp</label>
      </div>
      <div class="radio radio-css">

        <input type="radio" id="cpork" name="cfoodeaten" value="Pork" />
        <label for="cpork">Pork&nbsp&nbsp&nbsp</label>
      </div>
      <div class="radio radio-css">

        <input type="radio" id="cnoodle" name="cfoodeaten" value="Noodle" />
        <label for="cnoodle">Noodle&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
      </div>
      <div class="radio radio-css">

        <input type="radio" id="cfruitjuice" name="cfoodeaten" value="Fruit Juice"/>
        <label for="cfruitjuice">Fruit Juice&nbsp&nbsp</label>
      </div>

      <div class="radio radio-css">

        <input type="radio" id="cchicken" name="cfoodeaten" value="Chicken" />
        <label for="cchicken">Chicken&nbsp&nbsp&nbsp&nbsp</label>
      </div>

      <div class="radio radio-css">

        <input type="radio" id="csoup" name="cfoodeaten" value="Soup" />
        <label for="csoup">Soup&nbsp&nbsp</label>
      </div>

      <div class="radio radio-css">

        <input type="radio" id="cmilk" name="cfoodeaten" value="Milk" />
        <label for="cmilk">Milk&nbsp&nbsp</label>
      </div>
      <div class="radio radio-css">

        <input type="radio" id="cbeef" name="cfoodeaten" value="Beef" />
        <label for="cbeef">Beef&nbsp&nbsp</label>
      </div>
      <div class="radio radio-css">

        <input type="radio" id="cbread" name="cfoodeaten" value="Bread" />
        <label for="cbread">Bread&nbsp&nbsp</label>
      </div>
      <div class="radio radio-css">

        <input type="radio" id="cfish" name="cfoodeaten" value="Fish" />
        <label for="cfish">Fish&nbsp&nbsp</label>
      </div>
      <div class="radio radio-css">

        <input type="radio" id="cfruits" name="cfoodeaten" value="Fruits" />
        <label for="cfruits">Fruits</label>
      </div>
    </div>

  </div>

</div>
</form>

</div>

</div>
<div class="modal-footer" align="center">
 
  <a href="javascript:;" class="btn btn-success"  id="edit-btn">Submit</a>
</div>
<!-- end #accordion -->
</div>


        </div>
        <!-- end panel-body -->



      </div>
      <!-- end panel add new -->
      {{--Nav Pill Body End--}}
    </div>
    <!-- end tab-pane -->
    <!-- begin tab-pane -->
    <div class="tab-pane fade" id="nav-pills-tab-2">
     <div class="panel panel-inverse">
      <div class="panel-heading">
        <div class="panel-heading-btn">
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        </div>
        <h4 class="panel-title">List of Residents</h4>
      </div>
      <!-- begin alert -->
      <div class="alert alert-yellow fade show">
        <button type="button" class="close" data-dismiss="alert">
          <span aria-hidden="true">&times;</span>
        </button>
        Add new profile for children.
      </div>
      <div class="panel-body">
       <table id="data-table-default" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th hidden>Resident ID </th>
            <th style="">FullName </th>
            <th style="">Gender </th>
            <th style="width: 12%">Actions </th>
          </tr>
        </thead>

        <tbody>

        </tbody>
      </table>
    </div>

  </div>
</div>

{{--Table--}}
{{--Nav Pill Body End--}}
</div>

<!-- end tab-pane -->
</div>
<!-- end tab-content -->

</div>

<!-- #modal-hearing -->
<div class="modal fade" id="UpdateModal">
    <div class="modal-dialog" style="max-width: 75%">
        <form id="updateChildProfile" method="POST">
            @csrf

            <div class="modal-content">
                <div class="modal-header" style="background-color:#008a8a;">
                    <h4 class="modal-title" style="color: white">Update Child's Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">×</button>
                </div>
                <div class="modal-body">
                {{--modal body start--}}
                <h><label style="display: block; text-align: center">Residents's Name</label></h>
                <h3><b><label style="text-transform: capitalize; display: block; text-align: center" id="childName" name="childName"></label></b></h3><br>
                <input id="childID" type="text" hidden="true" />
                    <!--START CHILDREN PROFILE ACCORDION--> 
                    <div id="accordion" class="card-accordion">
                        <!--START CHILDREN PROFILE CARD-->
                        <div class="card">
                            <div class="card-header text-white pointer-cursor"  style="background-color: #7cb5ec" data-toggle="collapse" data-target="#childProfile">
                               <h><label style="display: block; text-align: center; color: white">Children's Profile</label></h>
                            </div>
                            <!--START CHILDREN PROFILE ACCORDION-->
                            <div id="childProfile" class="collapse show" data-parent="#accordion">
                                <div class="card-body">
                                This includes information about the children.
                                </div>
                                <!-- START ROW -->
                                <div class="row">
                                    <!-- START COL -->
                                    <div class="col-lg-5">
                                        <label style="display: block; text-align: left;">&nbsp&nbsp&nbspIs registered?</label>
                                        <div class=" col-md-6">
                                            <div class="stats-content">
                                                <div class="radio radio-css">
                                                    <input class="form-control" type="radio" name="ecisregistered" id="ecssIsregisteredYes" value=1 />
                                                    <label for="ecssIsregisteredYes">Yes</label>
                                                </div>

                                                <div class="radio radio-css">
                                                    <input class="form-control" type="radio" name="ecisregistered" id="ecssIsregisteredNo" value=0 />
                                                    <label for="ecssIsregisteredNo">No</label>
                                                </div><br>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END COL -->
                                    <!-- START COL -->
                                    <div class="col-lg-5">
                                        <label style="display: block; text-align: left">&nbsp&nbsp&nbspBorn at</label>
                                        <div class=" col-md-6">
                                            <div class="stats-content">
                                                <div class="radio radio-css">
                                                    <input type="radio" name="ecbornat" id="echospital" value="Hospital" checked />
                                                    <label for="echospital">Hospital</label>
                                                </div>

                                                <div class="radio radio-css">
                                                    <input type="radio" name="ecbornat" id="echservices" value="Health Center"  />
                                                    <label for="echservices">Health Center</label>
                                                </div>

                                                <div class="radio radio-css">
                                                    <input type="radio" name="ecbornat" id="echome" value="Home" />
                                                    <label for="echome">Home</label>
                                                </div><br>
                                            </div>
                                        </div>
                                    </div>   
                                    <!-- END COL -->
                                    <!-- START COL -->
                                    <div class="col-lg-2">
                                        <div class=" col-md-10">
                                            <label for="echeight">Height(cm)</label>
                                            <input type="number" class="form-control" name="ecstats" id="echeight" /><br>

                                            <label for="ecweights">Weight(kg)</label>
                                            <input type="number" class="form-control"  name="ecstats" id="ecweights" /><br>

                                            <label style="display: block; text-align: left">Birth Order</label>
                                            <div>
                                              <input class="form-control" type="number" max="15"  min="1" name="ecbrthorder" id="ecbrthorder" />
                                            </div> 
                                        </div>
                                    </div>
                                    <!-- END COL -->
                                </div> <br>
                                <!-- EMD ROW -->
                                <!-- START ROW -->
                                <div class="row">
                                    <!-- START COL -->
                                    <div class="col-lg-5">
                                        <label style="display: block; text-align: left">&nbsp&nbsp&nbspMother Tongue</label>
                                        <div class=" col-md-6">
                                            <div class="stats-content">
                                                <div class="radio radio-css">
                                                    <input type="radio" name="ecmtongue" id="ectagalog" value="Tagalog" checked />
                                                    <label for="ectagalog">Tagalog</label>
                                                </div>

                                                <div class="radio radio-css">
                                                    <input type="radio" name="ecmtongue" id="ecvisayan" value="Visayan"  />
                                                    <label for="ecvisayan">Visayan</label>
                                                </div>

                                                <div class="radio radio-css">
                                                    <input type="radio" name="ecmtongue" id="ecilogo" value="Iloco" />
                                                    <label for="ecilogo">Iloco</label>
                                                </div>

                                                <div class="radio radio-css">
                                                    <input type="radio" name="ecmtongue" id="ecbicolnon" value="Bicolnon" />
                                                    <label for="ecbicolnon">Bicolnon</label>
                                                </div><br>

                                                <div >
                                                   <label for="ecbicolnon">Others please specify:</label>
                                                   <textarea class="form-control" type="text-area" name="ecm_others" id="ecm_others"></textarea>
                                                </div><br>   
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END COL -->
                                    <!-- START COL -->
                                    <div class="col-lg-5">
                                        <label style="display: block; text-align: left">&nbsp&nbsp&nbspDoes the child have:</label>
                                        <div class=" col-md-6">
                                            <div class="stats-content">
                                              <div class="checkbox checkbox-css">
                                                  <input type="checkbox" name="ecddchild" id="ececcd" value=0 />
                                                  <label for="ececcd">ECCD Card</label>
                                              </div>
                                              <div class="checkbox checkbox-css">
                                                  <input type="checkbox" name="ecddchild" id="ecmcbook" value=0  />
                                                  <label for="ecmcbook">Mother & Child book</label>
                                              </div><br><br><br>
                                              <div>
                                                  <label for="">Others please specify:</label>
                                                  <textarea class="form-control" type="text-area" name="ecddothers" id="ecddothers"></textarea>
                                              </div>
                                            </div>
                                        </div>
                                    </div>   
                                    <!-- END COL -->
                                </div>
                                <!-- END ROW -->
                            </div>
                            <!--END CHILDREN PROFILE ACCORDION-->
                        </div>
                        <!--END CHILDREN PROFILE CARD-->
                <!--START VACCINATION CARD-->
                <div class="card">
                    <div class="card-header text-white pointer-cursor collapsed" style="background-color: #e89bbf" data-toggle="collapse" data-target="#childVaccine">
                       <h><label style="display: block; text-align: center; color: white">Vaccination and other health data</label></h> 
                    </div>
                    <!--START VACCINATION ACCORDION-->
                    <div id="childVaccine" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                         Vaccination and other data
                        </div>
                        <!--START ROW-->
                        <div class="row">
                            <!--START COL-->
                            <div class="col-lg-5">
                                <label style="display: block; text-align: left;">&nbsp&nbsp&nbsp&nbsp&nbspBCG</label>
                                <div class=" col-md-6">
                                    <div class="stats-content">
                                        <div class="radio radio-css">
                                            <input class="form-control" type="radio" name="ecbcg" id="hasBCG" value="Yes" checked />
                                            <label for="hasBCG">Yes</label>
                                        </div>

                                        <div class="radio radio-css">
                                            <input class="form-control" type="radio" name="ecbcg" id="hasNoBCG" value="No" />
                                            <label for="hasNoBCG">No</label>
                                        </div>

                                        <div class="radio radio-css">
                                            <input type="radio" id="dontKnowBCG" name="ecbcg" value="Don't know" />
                                            <label for="dontKnowBCG">Don't know</label>
                                        </div> <br>
                                    </div>
                                </div>
                            </div>
                            <!--END COL-->
                            <!--START COL-->
                            <div class="col-lg-5">
                                <label style="display: block; text-align: left">&nbspDPT</label>
                                <div >
                                    <div class="radio radio-css">
                                        <input type="radio" id="hasDPT" name="ecdpt" value="Yes" checked />
                                        <label for="hasDPT">Yes</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="hasNoDPT" name="ecdpt" value="No" />
                                        <label for="hasNoDPT">No</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="dontKnowDPT" name="ecdpt" value="Don't know" />
                                        <label for="dontKnowDPT">Don't know</label>
                                    </div>
                                </div>
                            </div>
                            <!--END COL-->
                            <!--start COL-->
                            <div class="col-lg-2">
                                <label style="display: block; text-align: left">&nbspOral Polio</label>
                                <div >
                                    <div class="radio radio-css">
                                        <input type="radio" id="oralPolio" name="ecpolio" value="Yes" checked />
                                        <label for="oralPolio">Yes</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="noOralPolio" name="ecpolio" value="No" />
                                        <label for="noOralPolio">No</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="dontKnowOralPolio" name="ecpolio" value="Don't know" />
                                        <label for="dontKnowOralPolio">Don't know</label>
                                    </div>
                                </div>
                            </div>
                            <!--END COL-->
                        </div><br>
                        <!--END ROW-->
                        <!--START ROW-->
                        <div class="row">
                            <!--START COL-->
                            <div class="col-lg-5">
                                <div class=" col-md-6">
                                    <label style="display: block; text-align: left">&nbspHepa B</label>
                                    <div >
                                        <div class="radio radio-css">
                                            <input type="radio" id="hepaB" name="echepab" value="Yes" checked />
                                            <label for="hepaB">Yes</label>
                                        </div>

                                        <div class="radio radio-css">
                                            <input type="radio" id="noHepaB" name="echepab" value="No" />
                                            <label for="noHepaB">No</label>
                                        </div>

                                        <div class="radio radio-css">
                                            <input type="radio" id="dontKnowHepaB" name="echepab" value="Don't know"/>
                                            <label for="dontKnowHepaB">Don't know</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END COL-->
                            <!--START COL-->
                            <div class="col-lg-5">
                                <label style="display: block; text-align: left">&nbspMeasles</label>
                                <div >
                                    <div class="radio radio-css">
                                        <input type="radio" id="hasMeasles" name="ecmeasles" value="Yes" checked />
                                        <label for="hasMeasles">Yes</label>
                                    </div>
                                    <div class="radio radio-css">
                                        <input type="radio" id="hasNoMeasles" name="ecmeasles" value="No"/>
                                        <label for="hasNoMeasles">No</label>
                                    </div>
                                    <div class="radio radio-css">
                                        <input type="radio" id="dontKnowMeasles" name="ecmeasles" value="Don't know"/>
                                        <label for="dontKnowMeasles">Don't know</label>
                                    </div> <br>
                                </div>
                            </div>
                            <!--END COL-->
                            <!--START COL-->
                            <div class="col-lg-2">
                                <div>
                                    <label style="display: block; text-align: left">Others</label>
                                    <textarea class="form-control" id="ecmeaslesthers" ></textarea> 
                                </div>
                            </div>
                          <!--END COL-->
                        </div>
                        <!--END ROW-->
                    </div>
                    <!--START VACCINATION ACCORDION-->
                </div>
                <!--END VACCINATION CARD -->
                <!--START PHYSICAL ATTRIBUTES CARD -->
                <div class="card">
                    <div class="card-header text-white pointer-cursor collapsed" style="background-color: #91a5b8" data-toggle="collapse" data-target="#childPhysical">
                      <h><label style="display: block; text-align: center; color: white">Physical Attributes data</label></h> 
                    </div>
                    <!--START PHYSICAL ATTRIBUTES ACCORDION -->
                    <div id="childPhysical" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                         Physical attribute of the children
                        </div>
                        <!--START ROW-->
                        <div class="row">
                            <!--START COL-->
                            <div class="col-lg-5">
                                <div class=" col-md-6">
                                    <label style="display: block; text-align: left">&nbspPhysical Deformity</label>
                                    <div >
                                        <div class="checkbox checkbox-css">
                                            <input type="checkbox" id="echlip" name="ecpdefo" value=0/>
                                            <label for="echlip">Hare Lip</label>
                                        </div>

                                        <div class="checkbox checkbox-css">
                                            <input type="checkbox" id="ecdleg" name="ecpdefo" value=0 />
                                            <label for="ecdleg">Disabled Leg</label>
                                        </div>

                                        <div class="checkbox checkbox-css">
                                            <input type="checkbox" id="ecdarm" name="ecpdefo" value=0 />
                                            <label for="ecdarm">Disabled Arm/Hand</label>
                                        </div>

                                        <div class="checkbox checkbox-css">
                                            <input type="checkbox" id="ecrossseyed" name="ecpdefo" value=0 />
                                            <label for="ecrossseyed">Cross-Eyed (Duling or Banlag)</label>
                                        </div>

                                        <div class="checkbox checkbox-css">
                                            <input type="checkbox" id="ecdeaf" name="ecpdefo" value=0 />
                                            <label for="ecdeaf">Deaf</label>
                                        </div>

                                        <div class="checkbox checkbox-css">
                                            <input type="checkbox" id="ecblind" name="ecpdefo" value=0 />
                                            <label for="ecblind">Blind</label>
                                        </div>

                                        <div class="checkbox checkbox-css">
                                            <input type="checkbox" id="ecftoes" name="ecpdefo" value=0 />
                                            <label for="ecftoes">Deformity in Fingers/Toes</label>
                                        </div>
                                    </div><br>
                                </div>
                            </div>
                            <!--END COL-->
                            <!--START COL-->
                            <div class="col-lg-5">
                                <label style="display: block; text-align: left">&nbspProblems with</label>
                                <div>
                                    <div class="checkbox checkbox-css">
                                        <input type="checkbox" id="ecbehavior" name="ecpwith" value=1 checked />
                                        <label for="ecbehavior">Behavior</label>
                                    </div>

                                    <div class="checkbox checkbox-css">
                                        <input type="checkbox" id="ecspeaking" name="ecpwith" value=0 />
                                        <label for="ecspeaking">Speaking</label>
                                    </div>

                                    <div class="checkbox checkbox-css">
                                        <input type="checkbox" id="echearing" name="ecpwith" value=0 />
                                        <label for="echearing">Hearing</label>
                                    </div>

                                    <div class="checkbox checkbox-css">
                                        <input type="checkbox" id="ecvision" name="ecpwith" value=0 />
                                        <label for="ecvision">Vision</label>
                                    </div>
                                </div>
                            </div>
                            <!--END COL-->
                            <!--START COL-->
                            <div class="col-lg-2">
                                <label style="display: block; text-align: left">&nbspLeft Handed</label>
                                <div>
                                    <div class="radio radio-css">
                                        <input type="radio" id="eclyes" name="eclefthanded" value=1 checked />
                                        <label for="eclyes">Yes</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="eclno" name="eclefthanded" value=0 />
                                        <label for="eclno">No</label>
                                    </div>
                                </div>
                            </div>
                            <!--END COL-->
                        </div>
                        <!--END ROW-->
                    </div>
                    <!--END PHYSICAL ATTRIBUTES ACCORDION -->
                </div> 
                <!--END PHYSICAL ATTRIBUTES CARD -->
                <!--START CHILDHOOD EXPERIENCE CARD-->
                <div class="card">
                    <div class="card-header text-white pointer-cursor collapsed" style="background-color: #808e9c" data-toggle="collapse" data-target="#childExperience">
                      <h><label style="display: block; text-align: center; color: white">Prior Early Childhood Experience Item</label></h> 
                    </div>
                    <!--START PHYSICAL ATTRIBUTE ACCORDION-->
                    <div id="childExperience" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                         Early experience of the children
                        </div>
                        <!--START ROW-->
                        <div class="row">
                            <!--START COL-->
                            <div class="col-lg-5">
                                <div class=" col-md-6">
                                    <label style="display: block; text-align: left">&nbspChildhood Experience</label>
                                    <div >
                                        <div>
                                            <div class="checkbox checkbox-css">
                                                <input type="checkbox" id="ecnursery" name="eexpi" value=1 checked />
                                                <label for="ecnursery">Nursery</label>
                                            </div>

                                            <div class="checkbox checkbox-css">
                                                <input type="checkbox" id="eckinder" name="eexpi" value=0 />
                                                <label for="eckinder">Kindergarten</label>
                                            </div>

                                            <div class="checkbox checkbox-css">
                                                <input type="checkbox" id="ecprepa" name="eexpi" value=0 />
                                                <label for="ecprepa">Preparatory</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END COL-->
                            <!--START COL-->
                            <div class="col-lg-5">
                                <label style="display: block; text-align: left">&nbspLearns at</label>
                                <div>
                                    <div class="radio radio-css">
                                        <input type="radio" id="elpre" name="eclearsat" value="Public Pre-School" />
                                        <label for="elpre">Public Pre-School</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="elprivate" name="eclearsat" value="Private Day Care" />
                                        <label for="elprivate">Private Day Care</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="elpublic" name="eclearsat" value="Public Day Care" />
                                        <label for="elpublic">Public Day Care</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="elchurch" name="eclearsat" value="Church-Based" />
                                        <label for="elchurch">Church-Based</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="elhomeb" name="eclearsat" value="Home-Based" />
                                        <label for="elhomeb">Home-Based</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="elprivatepre" name="eclearsat" value="Private Pre-School" />
                                        <label for="elprivatepre">Private Pre-School</label>
                                    </div><br>

                                    <label style="display: block; text-align: left">Others</label>
                                    <div>
                                        <textarea class="col-lg-4 form-control" id="el_others" ></textarea> 
                                    </div>
                                </div>
                            </div>
                            <!--END COL-->
                        </div>
                        <!--END ROW-->
                    </div>
                    <!--END PHYSICAL ATTRIBUTE ACCORDION-->
                </div>
                <!--END PHYSICAL ATTRIBUTE CARD-->
                <!--START PERFORMANCE CARD-->
                <div class="card">
                    <div class="card-header text-white pointer-cursor collapsed" style="background-color: #70e08a" data-toggle="collapse" data-target="#childPerformance">
                        <h><label style="display: block; text-align: center; color: white"> Other Performance Related Inputs</label></h>
                    </div>
                    <!--START PERFORMANCE ACCORDION-->
                    <div id="childPerformance" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          Performance related inputs
                        </div>
                        <!--START ROW-->
                        <div class="row">
                          <!--START COL-->
                            <div class="col-lg-5">
                                <div class=" col-md-6">
                                    <label style="display: block; text-align: left">&nbspLearns at Home with:</label>
                                    <div>
                                        <div class="checkbox checkbox-css">
                                            <input type="checkbox" id="ecmfboth" name="eclathomewith" value=0  />
                                            <label for="ecmfboth">Mother/Father/Both</label>
                                        </div>

                                        <div class="checkbox checkbox-css">
                                            <!-- cnbody, cmfboth, csiblings, crela, chhelp, ctutor, cperfri -->
                                            <input type="checkbox" id="ecnbody" name="eclathomewith" value=1 checked />
                                            <label for="ecnbody">Nobody</label>
                                        </div>

                                        <div class="checkbox checkbox-css">
                                            <input type="checkbox" id="ecsiblings" name="eclathomewith" value=0 />
                                            <label for="ecsiblings">Siblings</label>
                                        </div>

                                        <div class="checkbox checkbox-css">
                                            <input type="checkbox" id="ecrela" name="eclathomewith" value=0  />
                                            <label for="ecrela">Relatives</label>
                                        </div>

                                        <div class="checkbox checkbox-css">
                                            <input type="checkbox" id="ecmaid" name="eclathomewith" value=0  />
                                            <label for="ecmaid">Househelp/Maid</label>
                                        </div>

                                        <div class="checkbox checkbox-css">
                                            <input type="checkbox" id="ectutor" name="ectutor" value=0  />
                                            <label for="ectutor">Tutor</label>
                                        </div>

                                        <label style="display: block; text-align: left">&nbspOthers</label>
                                        <div>
                                            <textarea class="form-control"id="ecperfri" name="eclathomewith_txt"></textarea> 
                                        </div><br>
                                    </div>
                                </div>
                            </div>
                            <!--END COL-->
                            <!--START COL-->
                            <div class="col-lg-5">
                                <label style="display: block; text-align: left">&nbspPlays Interact with:</label>
                                <div>
                                    <div class="checkbox checkbox-css">
                                        <input type="checkbox" id="ep_older" name="eclathomewith" value=1 checked="true" />
                                        <label for="ep_older">Older Siblings</label>
                                    </div>

                                     <div class="checkbox checkbox-css">
                                        <input type="checkbox" id="ep_younger" name="eclathomewith" value=0 />
                                        <label for="ep_younger">Younger Siblings</label>
                                    </div>

                                    <div class="checkbox checkbox-css">
                                        <input type="checkbox" id="ep_age" name="eclathomewith" value=0/>
                                        <label for="ep_age">Same Age</label>
                                    </div>
                                </div>
                            </div>
                            <!--END COL-->
                        </div>
                        <!-- END ROW -->
                    </div>
                    <!-- END PERFORMANCE ACCORDION -->
                </div>
                <!-- END CHILDHOOD EXPERIENCE CARD -->
                <!--START LOGISTIC-CARD-->
                <div class="card">
                    <div class="card-header text-white pointer-cursor collapsed" style="background-color: #f07883" data-toggle="collapse" data-target="#childLogistics">
                      <h><label style="display: block; text-align: center; color: white">Logistics</label></h>
                    </div>
                    <!--START LOGISTIC-ACCORDION-->
                    <div id="childLogistics" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                         Logistics
                        </div>
                        <!--START ROW-->
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="stats-content">
                                    <label >&nbspTravel time to DCC<span class="text-danger"></span></label> <span id="elblfirstname"></span>
                                    <input class="form-control" id="ectdcc" data-parsley-required="true" />
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="stats-content">
                                    <label >&nbspMode of transportation to DCC</label><span id="elblmiddlename"></span>
                                    <input class="form-control" id="ecmdcc" data-parsley-required="true" />
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="stats-content">
                                    <label >&nbspTravel time to NCDC</label><span id="elbllastname"></span>
                                    <input class="form-control" id="etncdc" data-parsley-required="true" />
                                </div>
                            </div>
                        </div> <br>
                        <!--END ROW-->
                        <!--START ROW-->
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="stats-content">
                                    <label >&nbspMode of transportation to NCDC</label><span id="elblmiddlename"></span>
                                    <input class="form-control" id="ecmncdc" data-parsley-required="true" />
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="stats-content">
                                    <label >&nbspPublic Transportation<span class="text-danger"></span></label> <span id="elblfirstname"></span>
                                    <input class="form-control" id="ecpublic" data-parsley-required="true" />
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="stats-content">
                                    <label >&nbspTransportation Fare</label><span id="elblmiddlename"></span>
                                    <input class="form-control" id="ectransfare" data-parsley-required="true" />
                                </div>
                            </div>
                        </div><br>
                        <!--END ROW-->
                        <!--START ROW-->
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="stats-content">
                                    <label >&nbspGoes to school with</label><span id="elbllastname"></span>
                                    <input class="form-control" id="ecgowith" data-parsley-required="true" />
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="stats-content">
                                    <label >&nbspChild development teacher</label><span id="elbllastname"></span>
                                    <input class="form-control" id="ecdevteacher" data-parsley-required="true" />
                                </div>
                            </div>
                        </div><br>
                        <!--END ROW-->
                        <!--START ROW-->
                        <div class="row">
                            <!--START EATS MEAL BEFORE GOING TO SCHOOL-->
                            <div class="col-lg-5">
                                <div class=" col-md-6">
                                <label style="display: block; text-align: left">Eats Meal Before Going To School:</label>
                                    <div>
                                        <div class="radio radio-css">
                                            <input type="radio" id="ee_always" name="eceatsmeals" value="Always" checked />
                                            <label for="ee_always">Always</label>
                                        </div>

                                        <div class="radio radio-css">
                                            <input type="radio" id="ee_most" name="eceatsmeals" value="Most of  the time" />
                                            <label for="ee_most">Most of the time</label>
                                        </div>

                                        <div class="radio radio-css">
                                            <input type="radio" id="ee_sometimes" name="eceatsmeals" value="Sometimes" />
                                            <label for="ee_sometimes">Sometimes</label>
                                        </div>

                                        <div class="radio radio-css">
                                            <input type="radio" id="ee_rarely" name="eceatsmeals" value="Rarely" />
                                            <label for="ee_rarely">Rarely</label>
                                        </div>

                                        <div class="radio radio-css">
                                            <input type="radio" id="ee_never" name="eceatsmeals" value="Never" />
                                            <label for="ee_never">Never</label>
                                        </div><br>
                                    </div>
                                </div>
                            </div>
                            <!--END EATS MEAL BEFORE GOING TO SCHOOL-->
                            <!--START HAS BAON-->
                            <div class="col-lg-5">
                                <label style="display: block; text-align: left">&nbspHas Baon:</label>
                                <div>
                                    <div class="radio radio-css">
                                        <input type="radio" id="ecmoney" name="echasbaon" value="Money" />
                                        <label for="ecmoney">Money</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="ecfood" name="echasbaon" value="Food" />
                                        <label for="ecfood">Food</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="ecboth" name="echasbaon" value="Both" />
                                        <label for="ecboth">Both</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="ecnone" name="echasbaon" value="None" />
                                        <label for="ecnone">None</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="echdontknow" name="echasbaon" value="Don't know" />
                                        <label for="echdontknow">Don't Know</label>
                                    </div>
                                </div>
                            </div>
                            <!--END HAS BAON-->
                            <!--START FOOD NORMALLY EATEN BY CHILD-->
                            <div class="col-lg-2">
                                <label style="display: block; text-align: left">&nbspFood Normally Eaten By Child:</label>
                                <div>
                                    <div class="radio radio-css">
                                        <input type="radio" id="ecveggy" name="ecfoodeaten" value="Vegetable" />
                                        <label for="ecveggy">Vegetable&nbsp&nbsp</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="ecrice" name="ecfoodeaten" value="Rice" />
                                        <label for="ecrice">Rice&nbsp&nbsp</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="eccereal" name="ecfoodeaten" value="Cereals" />
                                        <label for="eccereal">Cereals&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="ecpork" name="ecfoodeaten" value="Pork" />
                                        <label for="ecpork">Pork&nbsp&nbsp&nbsp</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="ecnoodle" name="ecfoodeaten" value="Noodle" />
                                        <label for="ecnoodle">Noodle&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                      </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="ecfruitjuice" name="ecfoodeaten" value="Fruit Juice"/>
                                        <label for="ecfruitjuice">Fruit Juice&nbsp&nbsp</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="ecchicken" name="ecfoodeaten" value="Chicken" />
                                        <label for="ecchicken">Chicken&nbsp&nbsp&nbsp&nbsp</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="ecsoup" name="ecfoodeaten" value="Soup" />
                                        <label for="ecsoup">Soup&nbsp&nbsp</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="ecmilk" name="ecfoodeaten" value="Milk" />
                                        <label for="ecmilk">Milk&nbsp&nbsp</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="ecbeef" name="ecfoodeaten" value="Beef" />
                                        <label for="ecbeef">Beef&nbsp&nbsp</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="ecbread" name="ecfoodeaten" value="Bread" />
                                        <label for="ecbread">Bread&nbsp&nbsp</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="ecfish" name="ecfoodeaten" value="Fish" />
                                        <label for="ecfish">Fish&nbsp&nbsp</label>
                                    </div>

                                    <div class="radio radio-css">
                                        <input type="radio" id="ecfruits" name="ecfoodeaten" value="Fruits" />
                                        <label for="ecfruits">Fruits</label>
                                    </div>
                                </div>
                            </div>
                            <!--END FOOD NORMALLY EATEN BY CHILD-->
                        </div>
                        <!--END ROW-->
                    </div>
                    <!--END LOGISTIC-ACCRODION-->
                </div>
                <!--END LOGISTIC-CARD-->
                {{--modal body end--}}
                <div class="modal-footer">
                    <a id="CloseBTN" href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                    <a id="updateBTN" name="updateBTN" href="javascript:;" class="btn btn-success">Update</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection