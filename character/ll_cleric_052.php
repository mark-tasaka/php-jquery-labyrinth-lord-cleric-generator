<!DOCTYPE html>
<html>
<head>
<title>Labyrinth Lord Cleric Character Generator</title>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
	<meta charset="UTF-8">
	<meta name="description" content="Labyrinth Lord Cleric Character Generator. Goblinoid Games.">
	<meta name="keywords" content="Labyrinth Lord, Goblinoid Games,HTML5,CSS,JavaScript">
	<meta name="author" content="Mark Tasaka 2018">
		

	<link rel="stylesheet" type="text/css" href="css/ll_cleric.css">
	<link rel="stylesheet" type="text/css" href="css/ll_cleric_post.css">
    
    
    <script type="text/javascript" src="./js/dieRoll.js"></script>
    <script type="text/javascript" src="./js/modifiers.js"></script>
    <script type="text/javascript" src="./js/hitPoinst.js"></script>
    <script type="text/javascript" src="./js/primeReq.js"></script>
    
    
    
</head>
<body>
    
    <!--PHP-->
    <?php
    
    include 'php/armour.php';
    include 'php/checks.php';
    include 'php/weapons.php';
    include 'php/gear.php';
    include 'php/coins.php';
    include 'php/encumbrance.php';
    
    
        if(isset($_POST["theCharacterName"]))
        {
            $characterName = $_POST["theCharacterName"];
    
        }
    
        if(isset($_POST["thePlayerName"]))
        {
            $playerName = $_POST["thePlayerName"];
        
        }    
    
        if(isset($_POST["theAlignment"]))
        {
            $alignment = $_POST["theAlignment"];
        }
    
        if(isset($_POST["theArmour"]))
        {
            $armour = $_POST["theArmour"];
        }
    
        $armourName = getArmour($armour)[0];
        $armourDefense = getArmour($armour)[1];
        $armourWeight = getArmour($armour)[2];
    
        if(isset($_POST["theShield"]))
        {
            $shield = $_POST["theShield"];
        }
    
        $shieldName = getShield($shield)[0];
        $shieldDefense = getShield($shield)[1];
        $shieldWeight = getShield($shield)[2];
    
        $totalAcDefense = $armourDefense + $shieldDefense;
        $totalArmourWeight = $shieldWeight + $armourWeight;
    
        $armourDefense = removeZero($armourDefense);
        $armourWeight = removeZero($armourWeight);
    
        $shieldDefense = removeZero($shieldDefense);
        $shieldWeight = removeZero($shieldWeight);
    
        if(isset($_POST["theGold"]))
        {
            $coins = $_POST["theGold"];
        }
    
        $coinQuantity = getCoins($coins)[0];
        $coinType = getCoins($coins)[1];
    
    
         
        $weaponArray = array();
        $weaponNames = array();
        $weaponDamage = array();
        $weaponWeight = array();
    
    
        if(isset($_POST["theWeapons"]))
        {
            foreach($_POST["theWeapons"] as $weapon)
            {
                array_push($weaponArray, $weapon);
            }
        }
    
    foreach($weaponArray as $select)
    {
        array_push($weaponNames, getWeapon($select)[0]);
    }
        
    foreach($weaponArray as $select)
    {
        array_push($weaponDamage, getWeapon($select)[1]);
    }
        
    $totalWeaponWeight = 0;
    
    foreach($weaponArray as $select)
    {
        array_push($weaponWeight, getWeapon($select)[2]);
        $totalWeaponWeight += getWeapon($select)[2];
    }
    
    

        $gearArray = array();
        $gearNames = array();
        $gearWeight = array();
    
    
        if(isset($_POST["theGear"]))
        {
            foreach($_POST["theGear"] as $weapon)
            {
                array_push($gearArray, $weapon);
            }
        }
    
        foreach($gearArray as $select)
        {
            array_push($gearNames, getGear($select)[0]);
        }
        
        $totalGearWeight = 0;
    
        foreach($gearArray as $select)
        {
            array_push($gearWeight, getGear($select)[1]);
            $totalGearWeight += getGear($select)[1];
        }
    
    $totalWeightCarried = $totalArmourWeight + $totalWeaponWeight + $totalGearWeight + $coinQuantity;
    
    $movementTurn = turnMovement($totalWeightCarried);
    
    $movementEncounter = encounterMovement($totalWeightCarried);
    
    $movementRunning = runningMovement($totalWeightCarried);
    
    
    
    ?>

    
	
<!-- JQuery -->
  <img id="character_sheet"/>
   <section>
           
		<span id="strength"></span>
		<span id="dexterity"></span> 
		<span id="constitution"></span> 
		<span id="intelligence"></span>
		<span id="wisdom"></span>
       <span id="charisma"></span>
		  
       
		<span id="strengthModDesc"></span>
		<span id="dexterityModDesc"></span> 
		<span id="constitutionModDesc"></span> 
		<span id="intelligenceModDesc"></span>
		<span id="wisdomModDesc"></span>
       <span id="charismaModDesc"></span>
       
       <span id="saveBreathAttack"></span>
       <span id="savePoisonDeath"></span>
       <span id="savePetrify"></span>
       <span id="saveWands"></span>
       <span id="saveSpell"></span>
       
       <span id="dieRollMethod"></span>
       
       <span id="level"></span>
       <span id="class">Cleric</span>
       <span id="exNextLevel"></span>
       
       <span id="meleeAc0"></span>
       <span id="meleeAc1"></span>
       <span id="meleeAc2"></span>
       <span id="meleeAc3"></span>
       <span id="meleeAc4"></span>
       <span id="meleeAc5"></span>
       <span id="meleeAc6"></span>
       <span id="meleeAc7"></span>
       <span id="meleeAc8"></span>
       <span id="meleeAc9"></span>
       
       <span id="missileAc0"></span>
       <span id="missileAc1"></span>
       <span id="missileAc2"></span>
       <span id="missileAc3"></span>
       <span id="missileAc4"></span>
       <span id="missileAc5"></span>
       <span id="missileAc6"></span>
       <span id="missileAc7"></span>
       <span id="missileAc8"></span>
       <span id="missileAc9"></span>
       
       <span id="baseAc"></span>
       <span id="hitPoints"></span>
       <span id="primeReq"></span>
       <span id="modifiedAc"></span>
       
       <span id="turnUndead1"></span>
       <span id="turnUndead2"></span>
       <span id="turnUndead3"></span>
       <span id="turnUndead4"></span>
       <span id="turnUndead5"></span>
       <span id="turnUndead6"></span>
       <span id="turnUndead7"></span>
       <span id="turnUndead8"></span>
       <span id="turnUndead9"></span>
       <span id="turnUndead10"></span>
       
       <span id="spellLevel1"></span>
       <span id="spellLevel2"></span>
       <span id="spellLevel3"></span>
       <span id="spellLevel4"></span>
       <span id="spellLevel5"></span>
       <span id="spellLevel6"></span>
       <span id="spellLevel7"></span>
       
       <span id="characterName">
           <?php
                echo $characterName;
           ?>
        </span>
       
              
       <span id="playerName">
           <?php
                echo $playerName;
           ?>
        </span>
	                 
       <span id="alignment">
           <?php
                echo $alignment;
           ?>
        </span>
              
       <span id="armourName">
           <?php
                echo $armourName;
           ?>
        </span>
              
       <span id="armourAc">
           <?php
                echo $armourDefense;
           ?>
        </span>
              
       <span id="armourWeight">
           <?php
                echo $armourWeight;
           ?>
        </span>
       
              
       <span id="shieldName">
           <?php
                echo $shieldName;
           ?>
        </span>
              
       <span id="shieldAc">
           <?php
                echo $shieldDefense;
           ?>
        </span>
              
       <span id="shieldWeight">
           <?php
                echo $shieldWeight;
           ?>
        </span>
              
       <span id="totalArmourWeight">
            <?php
                echo $totalArmourWeight;
            ?>
       </span>
              
       <span id="totalArmourClassMod">
            <?php
                echo $totalAcDefense;
            ?>
       </span>
       
       <span id="weaponsList">
           <?php
           $val1 = 0;
           $val2 = 0;
           $val3 = 0;
           
           foreach($weaponNames as $theWeapon)
           {
               echo $theWeapon;
               echo "<br/>";
               $val1 = isWeaponTwoHanded($theWeapon, $val1);
               $val2 = isWeaponBastardSword($theWeapon, $val2);
           }
           
           $val3 = $val1 + $val2;
           
           $weaponNotes = weaponNotes($val3);
           
           ?>  
        </span>
       
       <span id="weaponNotes">
           <?php
                echo $weaponNotes;
           ?>
        </span>
            
       <span id="weaponsList2">
           <?php
           foreach($weaponDamage as $theWeaponDam)
           {
               echo $theWeaponDam;
               echo "<br/>";
           }
           ?>        
        </span>
       

            
       <span id="weaponsList3">
           <?php
           foreach($weaponWeight as $theWeapon)
           {
               echo $theWeapon;
               echo "<br/>";
           }
           ?>        
        </span>
       
       <span id="totalWeaponWeight">
           <?php
           echo $totalWeaponWeight;
           ?>
       </span>

              
       <span id="gearList">
           <?php
           
           foreach($gearNames as $theGear)
           {
               echo $theGear;
               echo "<br/>";
           }
           ?>
       </span>
           
              
       <span id="gearList2">
           <?php
           
           foreach($gearWeight as $theGear)
           {
               echo $theGear;
               echo "<br/>";
           }
           ?>  
        </span>
	   	   
       
       <span id="totalGearWeight">
           <?php
           echo $totalGearWeight;
           ?>
       </span>
       
       
       
       <span id="totalWeightCarried">
           <?php
           echo $totalWeightCarried . " lbs";
           ?>
       </span>
              
       
       <span id="wealth">
           <?php
           echo ($coinQuantity * 10) . $coinType;
           ?>
       </span>
       
       <span id="coinWeight">
           <?php
           echo $coinQuantity . " lbs";
           ?>
       </span>
       
              
       <span id="turnMove">
           <?php
           echo $movementTurn;
           ?>
       </span>
       
       
       <span id="encounterMove">
           <?php
           echo $movementEncounter;
           ?>
       </span>
       
       <span id="runningMove">
           <?php
           echo $movementRunning;
           ?>
       </span>
       
       
	</section>
	

		
  <script>
      

	  
	/*
	 Character() - Cleric Character Constructor
	*/
	function Character() {

        let strength = rollDice(6, 4, 1, 0);
        let dexterity = rollDice(6, 4, 1, 0);
        let constitution = rollDice(6, 4, 1, 0);
        let	intelligence = rollDice(6, 4, 1, 0);
        let	wisdom = rollDice(6, 4, 1, 0);
        let	charisma = rollDice(6, 4, 1, 0);
        let wisdomMod = abilityScoreModifier(wisdom);
        let strengthMod = abilityScoreModifier(strength);
        let dexterityMod = abilityScoreModifier(dexterity);
        let constitutionMod = abilityScoreModifier(constitution);
        let cleric = getCleric();
		
		let clericCharacter = {
			"strength": strength,
			"dexterity": dexterity,
			"constitution": constitution,
			"intelligence": intelligence,
			"wisdom": wisdom,
			"charisma": charisma,
            "strengthMod": abilityScoreModifier(strength),
            "strengthModifyDes": strengthModifierDescription(strength),
            "dexterityMod": abilityScoreModifier(dexterity),
            "dexterityModifyDes": dexterityModifierDescription(dexterity),
            "constitutionMod": abilityScoreModifier(constitution),
            "constitutionModifyDes": constitutionModifierDescription(constitution),
            "intelligenceMod": abilityScoreModifier(intelligence),
            "intelligenceModifyDes": intelligenceModifierDescription(intelligence),
            "wisdomModifyDes": wisdomModifierDescription(wisdom),
            "charismaMod": abilityScoreModifier(charisma),
            "charismaModifyDes": charismaModifierDescription(charisma),
            "breathAttack": cleric.breathAttack,
            "poisonDeath": cleric.poisonDeath,
            "petrify": cleric.petrify,
            "wandsSave": cleric.wand - wisdomMod,
            "spellSave": cleric.spell - wisdomMod,
            "level": cleric.level,
            "nextLevelExp": cleric.exNext,
            "meleeHitAC0": cleric.thaco - (strengthMod),
            "meleeHitAC1": cleric.thaco - (strengthMod) - 1,
            "meleeHitAC2": cleric.thaco - (strengthMod) - 2,
            "meleeHitAC3": cleric.thaco - (strengthMod) - 3,
            "meleeHitAC4": cleric.thaco - (strengthMod) - 4,
            "meleeHitAC5": cleric.thaco - (strengthMod) - 5,
            "meleeHitAC6": cleric.thaco - (strengthMod) - 6,
            "meleeHitAC7": cleric.thaco - (strengthMod) - 7,
            "meleeHitAC8": cleric.thaco - (strengthMod) - 8,
            "meleeHitAC9": cleric.thaco - (strengthMod) - 9,
            "missileHitAC0": cleric.thaco - (dexterityMod),
            "missileHitAC1": cleric.thaco - (dexterityMod) - 1,
            "missileHitAC2": cleric.thaco - (dexterityMod) - 2,
            "missileHitAC3": cleric.thaco - (dexterityMod) - 3,
            "missileHitAC4": cleric.thaco - (dexterityMod) - 4,
            "missileHitAC5": cleric.thaco - (dexterityMod) - 5,
            "missileHitAC6": cleric.thaco - (dexterityMod) - 6,
            "missileHitAC7": cleric.thaco - (dexterityMod) - 7,
            "missileHitAC8": cleric.thaco - (dexterityMod) - 8,
            "missileHitAC9": cleric.thaco - (dexterityMod) - 9,
            "acBase": 9 - dexterityMod,
            "acModified": <?php echo $totalAcDefense ?> + 9 - dexterityMod,
            "hp": hitPoints(cleric.hd, constitutionMod) + addHighLevelHp(cleric.level),
            "primeReqBonus": primeReq(wisdom),
            "turnHd1": cleric.turnUndead1,
            "turnHd1": cleric.turnUndead1,
            "turnHd2": cleric.turnUndead2,
            "turnHd3": cleric.turnUndead3,
            "turnHd4": cleric.turnUndead4,
            "turnHd5": cleric.turnUndead5,
            "turnHd6": cleric.turnUndead6,
            "turnHd7": cleric.turnUndead7,
            "turnHd8": cleric.turnUndead8,
            "turnHd9": cleric.turnUndead9,
            "turnHd10": cleric.turnUndeadInfernal,
            "level1Spells": cleric.spellLevel1,
            "level2Spells": cleric.spellLevel2,
            "level3Spells": cleric.spellLevel3,
            "level4Spells": cleric.spellLevel4,
            "level5Spells": cleric.spellLevel5,
            "level6Spells": cleric.spellLevel6,
            "level7Spells": cleric.spellLevel7,
			"dieRollMethod": "Ability Score Generation: 4d6, drop the lowest"
			
		
			

		};
	    if(clericCharacter.hitPoints <= 0 ){
			clericCharacter.hitPoints = 1;
		}
		return clericCharacter;
	  
	  }
	  

      
    /*getCleric() return the statistics for the Cleric per level*/  
    function getCleric() {
	let cleric = [
        
		{"level": 1,
		 "thaco": 19,
		 "breathAttack": 16,
		 "poisonDeath": 11,
		 "petrify": 14,
		 "wand": 12,
		 "spell": 15,
         "exNext": "1,565",
         "turnUndead1": "7",
         "turnUndead2": "9",
         "turnUndead3": "11",
         "turnUndead4": "-",
         "turnUndead5": "-",
         "turnUndead6": "-",
         "turnUndead7": "-",
         "turnUndead8": "-",
         "turnUndead9": "-",
         "turnUndeadInfernal": "-",
         "spellLevel1": "1",
         "spellLevel2": "-",
         "spellLevel3": "-",
         "spellLevel4": "-",
         "spellLevel5": "-",
         "spellLevel6": "-",
         "spellLevel7": "-",
         "hd": 1
        },
        
		{"level": 2,
		 "thaco": 19,
		 "breathAttack": 16,
		 "poisonDeath": 11,
		 "petrify": 14,
		 "wand": 12,
		 "spell": 15,
         "exNext": "3,125",
         "turnUndead1": "5",
         "turnUndead2": "7",
         "turnUndead3": "9",
         "turnUndead4": "11",
         "turnUndead5": "-",
         "turnUndead6": "-",
         "turnUndead7": "-",
         "turnUndead8": "-",
         "turnUndead9": "-",
         "turnUndeadInfernal": "-",
         "spellLevel1": "2",
         "spellLevel2": "-",
         "spellLevel3": "-",
         "spellLevel4": "-",
         "spellLevel5": "-",
         "spellLevel6": "-",
         "spellLevel7": "-",
         "hd": 2
        },
        
		{"level": 3,
		 "thaco": 19,
		 "breathAttack": 16,
		 "poisonDeath": 11,
		 "petrify": 14,
		 "wand": 12,
		 "spell": 15,
         "exNext": "6,251",
         "turnUndead1": "3",
         "turnUndead2": "5",
         "turnUndead3": "7",
         "turnUndead4": "9",
         "turnUndead5": "11",
         "turnUndead6": "-",
         "turnUndead7": "-",
         "turnUndead8": "-",
         "turnUndead9": "-",
         "turnUndeadInfernal": "-",
         "spellLevel1": "2",
         "spellLevel2": "1",
         "spellLevel3": "-",
         "spellLevel4": "-",
         "spellLevel5": "-",
         "spellLevel6": "-",
         "spellLevel7": "-",
         "hd": 3
        },
        
		{"level": 4,
		 "thaco": 18,
		 "breathAttack": 16,
		 "poisonDeath": 11,
		 "petrify": 14,
		 "wand": 12,
		 "spell": 15,
         "exNext": "12,501",
         "turnUndead1": "T",
         "turnUndead2": "3",
         "turnUndead3": "5",
         "turnUndead4": "7",
         "turnUndead5": "9",
         "turnUndead6": "11",
         "turnUndead7": "-",
         "turnUndead8": "-",
         "turnUndead9": "-",
         "turnUndeadInfernal": "-",
         "spellLevel1": "3",
         "spellLevel2": "2",
         "spellLevel3": "-",
         "spellLevel4": "-",
         "spellLevel5": "-",
         "spellLevel6": "-",
         "spellLevel7": "-",
         "hd": 4
        },
        
		{"level": 5,
		 "thaco": 18,
		 "breathAttack": 14,
		 "poisonDeath": 9,
		 "petrify": 12,
		 "wand": 10,
		 "spell": 12,
         "exNext": "25,001",
         "turnUndead1": "T",
         "turnUndead2": "T",
         "turnUndead3": "3",
         "turnUndead4": "5",
         "turnUndead5": "7",
         "turnUndead6": "9",
         "turnUndead7": "11",
         "turnUndead8": "-",
         "turnUndead9": "-",
         "turnUndeadInfernal": "-",
         "spellLevel1": "3",
         "spellLevel2": "2",
         "spellLevel3": "1",
         "spellLevel4": "-",
         "spellLevel5": "-",
         "spellLevel6": "-",
         "spellLevel7": "-",
         "hd": 5
        },
        
		{"level": 6,
		 "thaco": 17,
		 "breathAttack": 14,
		 "poisonDeath": 9,
		 "petrify": 12,
		 "wand": 10,
		 "spell": 12,
         "exNext": "50,001",
         "turnUndead1": "D",
         "turnUndead2": "T",
         "turnUndead3": "T",
         "turnUndead4": "3",
         "turnUndead5": "5",
         "turnUndead6": "7",
         "turnUndead7": "9",
         "turnUndead8": "11",
         "turnUndead9": "-",
         "turnUndeadInfernal": "-",
         "spellLevel1": "3",
         "spellLevel2": "3",
         "spellLevel3": "2",
         "spellLevel4": "-",
         "spellLevel5": "-",
         "spellLevel6": "-",
         "spellLevel7": "-",
         "hd": 6
        },
        
		{"level": 7,
		 "thaco": 17,
		 "breathAttack": 14,
		 "poisonDeath": 9,
		 "petrify": 12,
		 "wand": 10,
		 "spell": 12,
         "exNext": "100,001",
         "turnUndead1": "D",
         "turnUndead2": "D",
         "turnUndead3": "T",
         "turnUndead4": "T",
         "turnUndead5": "3",
         "turnUndead6": "5",
         "turnUndead7": "7",
         "turnUndead8": "9",
         "turnUndead9": "11",
         "turnUndeadInfernal": "-",
         "spellLevel1": "4",
         "spellLevel2": "3",
         "spellLevel3": "2",
         "spellLevel4": "1",
         "spellLevel5": "-",
         "spellLevel6": "-",
         "spellLevel7": "-",
         "hd": 7
        },
        
		{"level": 8,
		 "thaco": 17,
		 "breathAttack": 14,
		 "poisonDeath": 9,
		 "petrify": 12,
		 "wand": 10,
		 "spell": 12,
         "exNext": "200,001",
         "turnUndead1": "D",
         "turnUndead2": "D",
         "turnUndead3": "D",
         "turnUndead4": "T",
         "turnUndead5": "T",
         "turnUndead6": "3",
         "turnUndead7": "5",
         "turnUndead8": "7",
         "turnUndead9": "9",
         "turnUndeadInfernal": "11",
         "spellLevel1": "4",
         "spellLevel2": "3",
         "spellLevel3": "3",
         "spellLevel4": "2",
         "spellLevel5": "-",
         "spellLevel6": "-",
         "spellLevel7": "-",
         "hd": 8
        },
        
		{"level": 9,
		 "thaco": 16,
		 "breathAttack": 12,
		 "poisonDeath": 7,
		 "petrify": 10,
		 "wand": 8,
		 "spell": 9,
         "exNext": "300,001",
         "turnUndead1": "D",
         "turnUndead2": "D",
         "turnUndead3": "D",
         "turnUndead4": "D",
         "turnUndead5": "T",
         "turnUndead6": "T",
         "turnUndead7": "3",
         "turnUndead8": "5",
         "turnUndead9": "7",
         "turnUndeadInfernal": "9",
         "spellLevel1": "4",
         "spellLevel2": "4",
         "spellLevel3": "3",
         "spellLevel4": "2",
         "spellLevel5": "1",
         "spellLevel6": "-",
         "spellLevel7": "-",
         "hd": 9
        },
        
		{"level": 10,
		 "thaco": 16,
		 "breathAttack": 12,
		 "poisonDeath": 7,
		 "petrify": 10,
		 "wand": 8,
		 "spell": 9,
         "exNext": "400,001",
         "turnUndead1": "D",
         "turnUndead2": "D",
         "turnUndead3": "D",
         "turnUndead4": "D",
         "turnUndead5": "D",
         "turnUndead6": "T",
         "turnUndead7": "T",
         "turnUndead8": "3",
         "turnUndead9": "5",
         "turnUndeadInfernal": "7",
         "spellLevel1": "5",
         "spellLevel2": "4",
         "spellLevel3": "3",
         "spellLevel4": "3",
         "spellLevel5": "2",
         "spellLevel6": "-",
         "spellLevel7": "-",
         "hd": 9
        },
        
		{"level": 11,
		 "thaco": 15,
		 "breathAttack": 12,
		 "poisonDeath": 7,
		 "petrify": 10,
		 "wand": 8,
		 "spell": 9,
         "exNext": "500,001",
         "turnUndead1": "D",
         "turnUndead2": "D",
         "turnUndead3": "D",
         "turnUndead4": "D",
         "turnUndead5": "D",
         "turnUndead6": "D",
         "turnUndead7": "T",
         "turnUndead8": "T",
         "turnUndead9": "3",
         "turnUndeadInfernal": "5",
         "spellLevel1": "5",
         "spellLevel2": "5",
         "spellLevel3": "4",
         "spellLevel4": "3",
         "spellLevel5": "2",
         "spellLevel6": "1",
         "spellLevel7": "-",
         "hd": 9
        },
        
		{"level": 12,
		 "thaco": 14,
		 "breathAttack": 12,
		 "poisonDeath": 7,
		 "petrify": 10,
		 "wand": 8,
		 "spell": 9,
         "exNext": "600,001",
         "turnUndead1": "D",
         "turnUndead2": "D",
         "turnUndead3": "D",
         "turnUndead4": "D",
         "turnUndead5": "D",
         "turnUndead6": "D",
         "turnUndead7": "D",
         "turnUndead8": "T",
         "turnUndead9": "T",
         "turnUndeadInfernal": "3",
         "spellLevel1": "5",
         "spellLevel2": "5",
         "spellLevel3": "4",
         "spellLevel4": "3",
         "spellLevel5": "3",
         "spellLevel6": "2",
         "spellLevel7": "-",
         "hd": 9
        },
        
		{"level": 13,
		 "thaco": 13,
		 "breathAttack": 8,
		 "poisonDeath": 3,
		 "petrify": 8,
		 "wand": 4,
		 "spell": 6,
         "exNext": "700,001",
         "turnUndead1": "D",
         "turnUndead2": "D",
         "turnUndead3": "D",
         "turnUndead4": "D",
         "turnUndead5": "D",
         "turnUndead6": "D",
         "turnUndead7": "D",
         "turnUndead8": "D",
         "turnUndead9": "T",
         "turnUndeadInfernal": "T",
         "spellLevel1": "6",
         "spellLevel2": "5",
         "spellLevel3": "4",
         "spellLevel4": "4",
         "spellLevel5": "3",
         "spellLevel6": "2",
         "spellLevel7": "-",
         "hd": 9
        },
        
		{"level": 14,
		 "thaco": 13,
		 "breathAttack": 8,
		 "poisonDeath": 3,
		 "petrify": 8,
		 "wand": 4,
		 "spell": 6,
         "exNext": "800,001",
         "turnUndead1": "D",
         "turnUndead2": "D",
         "turnUndead3": "D",
         "turnUndead4": "D",
         "turnUndead5": "D",
         "turnUndead6": "D",
         "turnUndead7": "D",
         "turnUndead8": "D",
         "turnUndead9": "D",
         "turnUndeadInfernal": "T",
         "spellLevel1": "6",
         "spellLevel2": "5",
         "spellLevel3": "5",
         "spellLevel4": "4",
         "spellLevel5": "3",
         "spellLevel6": "3",
         "spellLevel7": "-",
         "hd": 9
        },
        
		{"level": 15,
		 "thaco": 12,
		 "breathAttack": 8,
		 "poisonDeath": 3,
		 "petrify": 8,
		 "wand": 4,
		 "spell": 6,
         "exNext": "900,001",
         "turnUndead1": "D",
         "turnUndead2": "D",
         "turnUndead3": "D",
         "turnUndead4": "D",
         "turnUndead5": "D",
         "turnUndead6": "D",
         "turnUndead7": "D",
         "turnUndead8": "D",
         "turnUndead9": "D",
         "turnUndeadInfernal": "T",
         "spellLevel1": "7",
         "spellLevel2": "6",
         "spellLevel3": "5",
         "spellLevel4": "4",
         "spellLevel5": "4",
         "spellLevel6": "3",
         "spellLevel7": "1",
         "hd": 9
        }
        

		
	];
	
	
	return cleric[4]; 
}

  
       let imgData = "images/cleric_character_sheet.png";
      
        $("#character_sheet").attr("src", imgData);
      

	  let data = Character();
		 
      $("#strength").html(data.strength);
      
      $("#dexterity").html(data.dexterity);
      
      $("#constitution").html(data.constitution);
      
      $("#intelligence").html(data.intelligence);
      
      $("#wisdom").html(data.wisdom);
      
      $("#charisma").html(data.charisma);
      
      $("#strengthModDesc").html(data.strengthModifyDes);
      $("#dexterityModDesc").html(data.dexterityModifyDes);
      $("#constitutionModDesc").html(data.constitutionModifyDes);
      $("#intelligenceModDesc").html(data.intelligenceModifyDes);
      $("#wisdomModDesc").html(data.wisdomModifyDes);
      $("#charismaModDesc").html(data.charismaModifyDes);
      
      $("#saveBreathAttack").html(data.breathAttack);
      $("#savePoisonDeath").html(data.poisonDeath);
      $("#savePetrify").html(data.petrify);
      $("#saveWands").html(data.wandsSave);
      $("#saveSpell").html(data.spellSave);
      
      $("#dieRollMethod").html(data.dieRollMethod);
      
      $("#level").html(data.level);
      $("#exNextLevel").html(data.nextLevelExp);
      
      $("#meleeAc0").html(data.meleeHitAC0);
      $("#meleeAc1").html(data.meleeHitAC1);
      $("#meleeAc2").html(data.meleeHitAC2);
      $("#meleeAc3").html(data.meleeHitAC3);
      $("#meleeAc4").html(data.meleeHitAC4);
      $("#meleeAc5").html(data.meleeHitAC5);
      $("#meleeAc6").html(data.meleeHitAC6);
      $("#meleeAc7").html(data.meleeHitAC7);
      $("#meleeAc8").html(data.meleeHitAC8);
      $("#meleeAc9").html(data.meleeHitAC9);
      
      $("#missileAc0").html(data.missileHitAC0);
      $("#missileAc1").html(data.missileHitAC1);
      $("#missileAc2").html(data.missileHitAC2);
      $("#missileAc3").html(data.missileHitAC3);
      $("#missileAc4").html(data.missileHitAC4);
      $("#missileAc5").html(data.missileHitAC5);
      $("#missileAc6").html(data.missileHitAC6);
      $("#missileAc7").html(data.missileHitAC7);
      $("#missileAc8").html(data.missileHitAC8);
      $("#missileAc9").html(data.missileHitAC9);
      
      $("#baseAc").html(data.acBase);
      $("#hitPoints").html(data.hp);
      $("#primeReq").html(data.primeReqBonus);
      $("#modifiedAc").html(data.acModified);
      $("#addAttack").html(data.secondAttack);

      $("#turnUndead1").html(data.turnHd1);
      $("#turnUndead2").html(data.turnHd2);
      $("#turnUndead3").html(data.turnHd3);
      $("#turnUndead4").html(data.turnHd4);
      $("#turnUndead5").html(data.turnHd5);
      $("#turnUndead6").html(data.turnHd6);
      $("#turnUndead7").html(data.turnHd7);
      $("#turnUndead8").html(data.turnHd8);
      $("#turnUndead9").html(data.turnHd9);
      $("#turnUndead10").html(data.turnHd10);
      
      $("#spellLevel1").html(data.level1Spells);
      $("#spellLevel2").html(data.level2Spells);
      $("#spellLevel3").html(data.level3Spells);
      $("#spellLevel4").html(data.level4Spells);
      $("#spellLevel5").html(data.level5Spells);
      $("#spellLevel6").html(data.level6Spells);
      $("#spellLevel7").html(data.level7Spells);
      
	 
  </script>
		
	
    
</body>
</html>