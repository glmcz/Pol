<script type='text/javascript' src='https://maps.google.cz/maps/api/js?sensor=false&#038;language=cs&#038;ver=4.2.58'></script>
<script type="text/javascript" src="<?php echo base_url('assets/template/js/gmaps.js');?>"></script>
<script>
var map1, map2;
$(document).ready(function(){
    
    var map = new GMaps({
        el: '#map',
        lat: 49.5399784,
        lng: 15.8481264,
        zoom: 7
    });
    
    map.addMarker({
        lat: 49.8351037,
        lng: 18.2874676,
        title: 'Ostrava Centrum',
        infoWindow: {
           content: '<p style="font-size: 16px;"><strong>Ostrava Centrum</strong></p><p>ARTFORUM knihkupectví Luděk Jičínský, Puchmajerova 8</p><p style="text-align: center;"><img width="260" src="'+ base_url + 'assets/uploads/images/map/ostrava_centrum.png" /></p>'
        }
    });
    
    map.addMarker({
      lat: 49.8351748,
      lng: 18.2606804,
      title: 'Ostrava Fifejdy',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Ostrava Fifejdy</strong></p><p>PUNČOCHOVÉ ZBOŽÍ – točna trolejbusů</p>'
      }
    });
    
    map.addMarker({
      lat: 49.8307082,
      lng: 18.2733054,
      title: 'Ostrava Moravská Ostrava',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Ostrava Moravská Ostrava</strong></p><p><strong>DOBRÁ ČAJOVNA NÁROČNÉHO PIJÁKA</strong> – ul. 28. října 124</p><p>vchod se nachází zleva v budově Domu kultury města Ostravy ze směru od sadu M. Horákové, zastávka MHD Krajský úřad</p><p style="text-align: center;"><img width="260" src="'+ base_url + 'assets/uploads/images/map/ostrava_moravska_ostrava.jpg" /></p>'
      }
    });
    
    map.addMarker({
      lat: 49.8281854,
      lng: 18.2564127,
      title: 'Ostrava Hulváky',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Ostrava Hulváky</strong></p><p><strong>ZDRAVÁ VÝŽIVA LAVENDER </strong> – ul. 28. října, naproti nové točny trolejbusů a stacionáře Duhový dům</p>'
      }
    });

    map.addMarker({
      lat: 49.8278645,
      lng: 18.2552904,
      title: 'Ostrava Mariánské Hory',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Ostrava Mariánské Hory</strong></p><p><strong>Knihkupectví SILEO</strong> – 28. října 66, nedaleko rohu u křižovatky Mariánské náměstí, (bývalý Librex)</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/Ostrava_Mariánské_Hory.png" /></p>'
      }
    });

    map.addMarker({
      lat: 49.7878616,
      lng: 18.2505428,
      title: 'Ostrava Hrabůvka',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Ostrava Hrabůvka</strong></p><p><strong>VIVA</strong> – Horní 55, nahoře v „Hlubiňáku“ vedle Broadwaye</p>'
      }
    });

    map.addMarker({
      lat: 49.7868701,
      lng: 18.2562311,
      title: 'Ostrava Hrabůvka',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Zdravá výživa Milota</strong></p><p><strong>Zdravá výživa Milota</strong> - Klegova 80, výškový dům za „Hlubiňákem“ u parkoviště za poliklinikou</p>'
      }
    });

    map.addMarker({
      lat: 49.8221192,
      lng: 18.1902717,
      title: 'Ostrava Poruba',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Ostrava Poruba</strong></p><p><strong>Centrum volného času</strong> - ul. Vietnamská, zastávka MHD Jižní svahy</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/Ostrava_Poruba.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.8279934,
      lng: 18.1711257,
      title: 'Ostrava Poruba',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Ostrava Poruba</strong></p><p><strong>Knihkupectví U Rondlu</strong> - Porubská 1016, (bývalý Librex) kousek od kruhového objezdu ve středu Hlavní třídy</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/Knihkupectví U Rondlu.png" /></p>'
      }
    });

    map.addMarker({
      lat: 49.8243346,
      lng: 18.1900207,
      title: 'Ostrava Poruba',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Ostrava Poruba</strong></p><p><strong>Dětský rehabilitační stacionář při Městské nemocnici Ostrava</strong> - Ukrajinská 1534/15</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/Dětský rehabilitační stacionář.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.7837001,
      lng: 18.2458648,
      title: 'Ostrava JIH',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Ostrava JIH</strong></p><p><strong>Eukalyptus - Dům zdraví a osobního rozvoje</strong> - U Letiště 1344/4 Ostrava-jih</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/Eukalyptus.jpg" /></p>'
      }
    });
    
    map.addMarker({
      lat: 49.9391223,
      lng: 17.9034992,
      title: 'OPAVA',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>OPAVA</strong></p><p><strong>JÍDELNA NA DOLŇÁKU</strong> - Dolní náměstí 26</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/JÍDELNA NA DOLŇÁKU.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.9366774,
      lng: 17.9034992,
      title: 'OPAVA',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>OPAVA</strong></p><p><strong>MG MEDICAL CENTER</strong> - Ostrožná 244/27, 1. patro</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/MG MEDICAL CENTER.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.9375697,
      lng: 17.8986293,
      title: 'OPAVA',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>OPAVA</strong></p><p><strong>MEDICAL CENTER</strong> - Popská 222/11</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/MEDICAL CENTER.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.8483115,
      lng: 18.5477186,
      title: 'KARVINÁ',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>KARVINÁ</strong></p><p><strong>NEMOCNICE S POLIKLINIKOU</strong> - Vydmuchov 399/5, Karviná-Ráj</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/NEMOCNICE S POLIKLINIKOU.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.5990986,
      lng: 18.1413218,
      title: 'KOPŘIVNICE',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>KOPŘIVNICE</strong></p><p><strong>ELIXÍR</strong> - Záhumenní 352, u supermarketu Albert</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/KOPŘIVNICE.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.5851486,
      lng: 18.1302504,
      title: 'ŠTRAMBERK',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ŠTRAMBERK</strong></p><p><strong>RESTAURACE U MÁMY</strong> - Na Vápenkách 372/7</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/RESTAURACE U MÁMY .jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.7105857,
      lng: 18.5281969,
      title: 'TŘANOVICE',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>TŘANOVICE</strong></p><p><strong>ŠENK U SPLAVU</strong> - Třanovice 225</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/ŠENK U SPLAVU.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.9179358,
      lng: 18.3332629,
      title: 'BOHUMÍN',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>BOHUMÍN</strong></p><p><strong>BOHUMÍNSKÁ MĚSTSKÁ NEMOCNICE</strong> - Slezská 207, Starý Bohumín</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/BOHUMÍNSKÁ MĚSTSKÁ NEMOCNICE.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.9064326,
      lng: 18.3496758,
      title: 'BOHUMÍN',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>BOHUMÍN</strong></p><p><strong>Středisko zdravotnických služeb – poliklinika</strong> - Čáslavská 1176</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/Středisko zdravotnických.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.8750423,
      lng: 18.4260599,
      title: 'ORLOVÁ',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ORLOVÁ</strong></p><p><strong>STŘEDISKO VOLNÉHO ČASU</strong> - DDM Orlová, Masarykova tř. 958</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/STŘEDISKO VOLNÉHO ČASU.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.8708348,
      lng: 18.4237348,
      title: 'ORLOVÁ',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ORLOVÁ</strong></p><p><strong>Bylinkárna</strong> - Masarykova třída 795</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/Bylinkárna.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.7764146,
      lng: 17.7505834,
      title: 'VÍTKOV (okr. Opava)',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>VÍTKOV (okr. Opava)</strong></p><p><strong>OBCHODNÍ STŘEDISKO TEMPO</strong> - Opavská 127</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/OBCHODNÍ STŘEDISKO TEMPO.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.6095387,
      lng: 17.9948535,
      title: 'ŠENOV U NOVÉHO JIČÍNA',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ŠENOV U NOVÉHO JIČÍNA</strong></p><p><strong>JÍDELNA AREÁLU PRAMEN CENTRUM</strong> - Dukelská 526</p>'
      }
    });

    map.addMarker({
      lat: 49.8639236,
      lng: 18.0913868,
      title: 'VELKÁ POLOM (u Ostravy)',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>VELKÁ POLOM (u Ostravy)</strong></p><p><strong>MÍSTNÍ KNIHOVNA VELKÁ POLOM</strong> - Osvoboditelů 67</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/MÍSTNÍ KNIHOVNA VELKÁ POLOM.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.4774104,
      lng: 18.1391077,
      title: 'ROŽNOV POD RADHOŠTĚM',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ROŽNOV POD RADHOŠTĚM</strong></p><p><strong>UNIPAR</strong> - Dolní Paseky 227</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/UNIPAR.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.2023597,
      lng: 16.6279354,
      title: 'BRNO',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>BRNO</strong></p><p><strong>VOJENSKÁ NEMOCNICE BRNO</strong> - Zábrdovická 3,Brno-Židenice</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/VOJENSKÁ NEMOCNICE BRNO.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.1984275,
      lng: 16.6543642,
      title: 'BRNO',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>BRNO</strong></p><p><strong>POLIKLINIKA VINIČNÍ</strong> - Viniční 4049/235</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/POLIKLINIKA VINIČNÍ.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.95913,
      lng: 16.9620147,
      title: 'ŠUMPERK',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ŠUMPERK</strong></p><p><strong>NEMOCNICE ŠUMPERK</strong> - Nerudova 640/41</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/NEMOCNICE ŠUMPERK.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.9639393,
      lng: 16.9787097,
      title: 'ŠUMPERK',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ŠUMPERK</strong></p><p><strong>DDM Vila Doris</strong> - 17.listopadu 691/2</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/DDM Vila Doris.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.9676604,
      lng: 16.9631762,
      title: 'ŠUMPERK',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ŠUMPERK</strong></p><p><strong>Klub důchodců</strong> - Temenická 11</p>'
      }
    });

    map.addMarker({
      lat: 49.9669849,
      lng: 16.9689968,
      title: 'ŠUMPERK',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ŠUMPERK</strong></p><p><strong>PRODEJNA PRAMÍNEK</strong> - Langrova 105/8</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/PRODEJNA PRAMÍNEK.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.9653395,
      lng: 16.9782047,
      title: 'ŠUMPERK',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ŠUMPERK</strong></p><p><strong>BIOARGA NATURA</strong> - 17. listopadu 7</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/BIOARGA NATURA.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.9642786,
      lng: 16.9724437,
      title: 'ŠUMPERK',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ŠUMPERK</strong></p><p><strong>BYLINKA.NET</strong> - M. R. Štefánika 849/8</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/BYLINKA.NET.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.9641521,
      lng: 16.9812636,
      title: 'ŠUMPERK',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ŠUMPERK</strong></p><p><strong>CHARITA ŠUMPERK</strong> - Jeremenkova 7</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/CHARITA ŠUMPERK.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.7802739,
      lng: 18.4299343,
      title: 'HAVÍŘOV',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>HAVÍŘOV</strong></p><p><strong>ZDRAVÁ VÝŽIVA SLUNÍČKO</strong> - Dlouhá 460/1</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/ZDRAVÁ VÝŽIVA SLUNÍČKO.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.7782848,
      lng: 18.43062,
      title: 'HAVÍŘOV',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>HAVÍŘOV</strong></p><p><strong>KRÁMEK U MOUDRÉ KOZY</strong> - Národní třída 6</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/KRÁMEK U MOUDRÉ KOZY.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.7790729,
      lng: 18.4288094,
      title: 'HAVÍŘOV',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>HAVÍŘOV</strong></p><p><strong>ZDRAVÁ VÝŽIVA HAVÍŘOV</strong> - nám. Republiky 572/4</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/ZDRAVÁ VÝŽIVA HAVÍŘOV.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.7778015,
      lng: 18.4354679,
      title: 'HAVÍŘOV',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>HAVÍŘOV</strong></p><p><strong>ŠANGRI-LA, Obchodní centrum REDON</strong> - E.F. Buriana 869/4a, přízemí se vstupem od parku</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/ŠANGRI-LA,_OBCHODNÍ_CENTRUM_REDON.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.7571372,
      lng: 16.6529403,
      title: 'MORAVSKÁ TŘEBOVÁ',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>MORAVSKÁ TŘEBOVÁ</strong></p><p><strong>NEMOCNICE NÁSLEDNÁ PÉČE-MORAVSKÁ TŘEBOVÁ</strong> - Svitavská 480/25, Předměstí</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/NEMOCNICE NÁSLEDNÁ PÉČE-MORAVSKÁ TŘEBOVÁ.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 50.8043153,
      lng: 14.4186592,
      title: 'ČESKÁ KAMENICE',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ČESKÁ KAMENICE</strong></p><p><strong>DOMOV PRO SENIORY A PEČOVATELSkÁ SLUŽBA</strong> - Sládkova 344</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/DOMOV PRO SENIORY A PEČOVATELSkÁ SLUŽBA.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 50.9256854,
      lng: 15.0852933,
      title: 'FRÝDLANT',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>FRÝDLANT</strong></p><p><strong>NEMOCNICE FRÝDLANT</strong> - V Úvoze 860</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/NEMOCNICE FRÝDLANT.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 50.8297283,
      lng: 15.0501453,
      title: 'MNÍŠEK',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>MNÍŠEK</strong></p><p><strong>ZDRAVOTNICKÉ STŘEDISKO</strong> - Ke Hřišti 309</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/ZDRAVOTNICKÉ STŘEDISKO.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 50.0417468,
      lng: 15.8116122,
      title: 'PARDUBICE',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>PARDUBICE</strong></p><p><strong>Poradna NRZP ČR v Pardubicích</strong> - Erno Košťála 1013, Sídlo poradny se nachází v objektu domu pro seniory na sídlišti Dubina.</p>'
      }
    });

    map.addMarker({
      lat: 50.0449935,
      lng: 14.4849345,
      title: 'PRAHA',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>PRAHA</strong></p><p><strong>Poliklinika Spořilov</strong> - Božkovská 2967/4</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/Poliklinika Spořilov.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.782624,
      lng: 14.688551,
      title: 'BENEŠOV',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>BENEŠOV</strong></p><p><strong>POLIKLINIKA BENEŠOV</strong> - Malé nám. 1700</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/POLIKLINIKA BENEŠOV.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.9620904,
      lng: 16.7612112,
      title: 'ŠTÍTY (okr.Šumperk)',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ŠTÍTY (okr.Šumperk)</strong></p><p><strong>Potraviny Coop</strong> - Náměstí Míru 42</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/Potraviny Coop.jpg" /></p>'
      }
    });

    map.addMarker({
      lat: 49.9897522,
      lng: 14.7397767,
      title: 'ŘÍČANY U PRAHY',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ŘÍČANY U PRAHY</strong></p><p><strong>Rosa market</strong> - Mukařov</p>'
      }
    });

     map.addMarker({
      lat: 50.0367579,
      lng: 15.7717143,
      title: 'PARDUBICE',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>PARDUBICE</strong></p><p><strong>KŘÍDLA DUŠE – sportovně relaxační centrum</strong> - Třída Míru 65</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/KŘÍDLA_DUŠE–SPORTOVNĚ_RELAXAČNÍ_CENTRUM.jpg" /></p>'
      }
    });

     map.addMarker({
      lat: 49.5445437,
      lng: 18.3039608,
      title: 'ČELADNÁ',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>ČELADNÁ</strong></p><p><strong>BESKYDSKÉ REHABILITAČNÍ CENTRUM, SPOL. S R. O.</strong> - Čeladná 42</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/BESKYDSKÉ_REHABILITAČNÍ_CENTRUM_SPOL._S.R.O.jpg" /></p>'
      }
    });

     map.addMarker({
      lat: 49.5435996,
      lng: 18.2144638,
      title: 'Frenštát pod Radhoštěm',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Frenštát pod Radhoštěm</strong></p><p><strong>MĚSTSKÁ KNIHOVNA</strong> - Dr. Parmy 254</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/MĚSTSKÁ_KNIHOVNA_Dr.Parmy_254.jpg" /></p>'
      }
    });

     map.addMarker({
      lat: 49.8066955,
      lng: 18.0961325,
      title: 'KLIMKOVICE',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>KLIMKOVICE</strong></p><p><strong>SANATORIA KLIMKOVICE</strong> - Klimkovice</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/SANATORIA_KLIMKOVICE_Klimkovice.jpg" /></p>'
      }
    });

     map.addMarker({
      lat: 49.5955542,
      lng: 18.1434576,
      title: 'KOPŘIVNICE',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>KOPŘIVNICE</strong></p><p><strong>THERÁPON98 KOPŘIVNICE</strong> - poliklinika, Štefánikova 1301/4</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/THERÁPON98-KOPŘIVNICE.jpg" /></p>'
      }
    });

     map.addMarker({
      lat: 49.4629217,
      lng: 17.97487,
      title: 'Valašské Meziříčí',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Valašské Meziříčí</strong></p><p><strong>NEMOCNICE VALAŠSKÉ MEZIŘÍČÍ A.S.</strong> - U nemocnice 980, v přízemí u informací</p><p style="text-align: center;"><img width="220" src="'+ base_url + 'assets/uploads/images/map/NEMOCNICE VALAŠSKÉ MEZIŘÍČÍ A.S..jpg" /></p>'
      }
    });


    //Slovakia
    map.addMarker({
      lat: 48.1613788,
      lng: 17.1285473,
      title: 'Slovensko, Bratislava',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Slovensko, Bratislava</strong></p><p>KULTURNÍ STŘEDISKO VAJNORSKÁ  - Vajnorská 21</p><p style="text-align: center;"><img width="260" src="'+ base_url + 'assets/uploads/images/map/vajnorska_21.jpg" /></p>'
      }
    });
    
    map.addMarker({
      lat: 48.1352173,
      lng: 17.2082473,
      title: 'Slovensko, Bratislava',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Slovensko, Bratislava</strong></p><p>OD HRON - Ipeľská 2, v prostorách tržnice</p>'
      }
    });

    map.addMarker({
      lat: 48.1484423,
      lng: 17.1052274,
      title: 'Slovensko, Bratislava',
      infoWindow: {
          content: '<p style="font-size: 16px;"><strong>Slovensko, Bratislava</strong></p><p>PREDAJNA BIOPOTRAVIN BIORAJ, obchod v podchode na Hodžovom námestí </p>'
      }
    });
    
    

});
</script>
<style type="text/css">
#map {
  width: 100%;
  height: 400px;
}
</style>

<div class="row">
    <div class="col-md-9">
        <div class="headline">
            <h3 style="color: red; margin: 0 0 10px 0; text-align: center;"><?php echo $this->lang->line('free_news');?></h3>
            <div id="map"></div>
            <div id="map_sidebar">
                <div class="text_below_map"></div>
            </div>
            <?php echo $content['text'];?>
        </div>
        <hr />
        <script type="text/javascript">(function() {
                if (window.pluso)if (typeof window.pluso.start == "function") return;
                if (window.ifpluso==undefined) { window.ifpluso = 1;
                    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                    var h=d[g]('body')[0];
                    h.appendChild(s);
                }})();
        </script>
        <div class="pluso" data-background="none;" data-options="medium,square,line,horizontal,counter,sepcounter=1,theme=14" data-services="facebook,twitter,google,linkedin,livejournal,pinterest,print,email"></div>
        <div class="clearfix"></div>
        <hr />
    </div>
    <div class="col-md-3">
        <div class="farewell">
            <div class="farewell-tale">
                <span class="farewell_title"><?php echo $this->lang->line('farewell');?></span><br />
                <p><span class="farewell_quote">“</span><?php echo $this->farewell['text'];?></p>
            </div>
        </div>
        <div class="clearfix"></div>
        <br />
        
        <div class="title_right"><?php echo $this->lang->line('calendar');?></div>
        <div id="mini-calendar"></div>
        <div class="clearfix"></div>
        <br />
    
        <?php foreach($this->modules as $module):?>
            <!--<div class="headline">
                <p class="lead"><?php /*echo $module['title'];*/?></p>
            </div>-->
            <?php echo $module['text'];?>
            <!--<br />-->
        <?php endforeach;?>

        <?php

            foreach($this->banners as $banner):

                if($banner['position'] == '1'){

                    $image = '<img class="img-responsive" src="'.base_url().'assets/uploads/images/banners/'.$banner['img_url'].'" alt="'.$banner['title'].'" title="'.$banner['title'].'" >';
                    echo '<div class="right_banner"><a href="'.$banner['link'].'" target="_blank">'.$image.'</a></div>';
                    // do something

                }

            endforeach;?>
    </div>
</div>