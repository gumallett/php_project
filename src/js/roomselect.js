function calcEstimatedCost() {
    var costElem = document.getElementById('stay_cost');
    var length = document.getElementById('stay_length').value;
    var numRooms = document.getElementById('num_rooms').value;
    var roomTypeForm = document.forms['room_type_form'];

    for(var key in roomTypeForm) {
        if(roomTypeForm.hasOwnProperty(key)) {
            var elem = roomTypeForm[key];
            if(elem.checked) {
                var selectedRoomCost = document.getElementById(elem.value+'_rate').textContent;
                costElem.innerHTML = '$'+((parseInt(length) * parseFloat(selectedRoomCost)).toFixed(2)*parseInt(numRooms));
            }
        }
    }
}