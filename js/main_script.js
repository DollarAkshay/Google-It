// *~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*
// *                                                  *
// *  Site Developed by Akshay Aradhya                *
// *  Website      : dollarakshay.com                 *
// *  Source Code  : https://github.com/dollarakshay  *
// *                                                  *
// *~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*

function validateForm(form) {

    var teamname = form.teamname.value;
    var password = form.password.value;
    
    
    
    if( teamname.length >= 6 ){
         if( teamname.length < 60 ){
             var re = new RegExp("^[0-9A-Za-z]*$");
             if( re.test(teamname) ){
                if( password.length >= 6 ){
                    return true;
                }
                else{
                    alert("Password has to be atleast 6 characters");
                    return false;
                }
             }
             else{
                alert("Team Name should contain only letters and numbers");
                return false;
            }
         }
         else{
            alert("Team Name has to be less than 60 characters");
            return false;
         }
    }
    else{
        alert("Team Name has to be atleast 6 characters");
        return false;
    }
    
}


console.log("                           Site Developed by                          ");
console.log("                                                                      ");
console.log("  /$$$$$$  /$$                 /$$                                    ");
console.log(" /$$__  $$| $$                | $$                                    ");
console.log("| $$  \ $$| $$   /$$  /$$$$$$$| $$$$$$$   /$$$$$$  /$$   /$$          ");
console.log("| $$$$$$$$| $$  /$$/ /$$_____/| $$__  $$ |____  $$| $$  | $$          ");
console.log("| $$__  $$| $$$$$$/ |  $$$$$$ | $$  \ $$  /$$$$$$$| $$  | $$          ");
console.log("| $$  | $$| $$_  $$  \____  $$| $$  | $$ /$$__  $$| $$  | $$          ");
console.log("| $$  | $$| $$ \  $$ /$$$$$$$/| $$  | $$|  $$$$$$$|  $$$$$$$          ");
console.log("|__/  |__/|__/  \__/|_______/ |__/  |__/ \_______/ \____  $$          ");
console.log("                                                   /$$  | $$          ");
console.log("                                                  |  $$$$$$/          ");
console.log("                                                   \______/           ");
console.log("                                                                      ");
console.log("  /$$$$$$                            /$$ /$$                          ");
console.log(" /$$__  $$                          | $$| $$                          ");
console.log("| $$  \ $$  /$$$$$$   /$$$$$$   /$$$$$$$| $$$$$$$  /$$   /$$  /$$$$$$ ");
console.log("| $$$$$$$$ /$$__  $$ |____  $$ /$$__  $$| $$__  $$| $$  | $$ |____  $$");
console.log("| $$__  $$| $$  \__/  /$$$$$$$| $$  | $$| $$  \ $$| $$  | $$  /$$$$$$$");
console.log("| $$  | $$| $$       /$$__  $$| $$  | $$| $$  | $$| $$  | $$ /$$__  $$");
console.log("| $$  | $$| $$      |  $$$$$$$|  $$$$$$$| $$  | $$|  $$$$$$$|  $$$$$$$");
console.log("|__/  |__/|__/       \_______/ \_______/|__/  |__/ \____  $$ \_______/");
console.log("                                                   /$$  | $$          ");
console.log("                                                  |  $$$$$$/          ");
console.log("                                                   \______/           ");
