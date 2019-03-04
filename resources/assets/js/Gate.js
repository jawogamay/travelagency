export default class Gate{

    constructor(user){
        this.user = user;
    }


    isAdmin(){
        return this.user.type === 'admin';
    }

    isUser(){
        return this.user.type === 'consultant';
    }
    isAdminOrAuthor(){
        if(this.user.type === 'admin' || this.user.type === 'accountant'){
            return true;
        }

    }
    isAuthorOrUser(){
        if(this.user.type === 'travelconsultant' || this.user.type === 'accountant'){
            return true;
        }

    }



}
