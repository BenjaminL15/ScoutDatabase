const awards = [
    "50-Miler Award",
    "Asian American Spirit of Scouting Service Award",
    "Alumni Award",
    "Boardsailing BSA Award",
    "BSA Council Alumnus of the Year Award",
    "BSA Lifeguard Award",
    "BSA Stand up Paddle Boarding Award",
    "BSA Distinguished Conservation Service Award",
    "Commissioner Awards and Recognitions",
    "Community Organization Award",
    "Conservation Good Turn Award",
    "Complete Angler",
    "Council Duty to God Award",
    "Cub Scout Leader Recognition Awards",
    "Cub Scout Outdoor Activity Award",
    "Den Chief Service Award",
    "Den Leader Training Awards",
    "Distinguished Conservation Service Award",
    "Distinguished Eagle Scout Award",
    "District Award of Merit",
    "Elbert K.Fretwell Outstanding Educator Award",
    "Endowment Achievement Award",
    "Firem’n Chit Award",
    "Founders Bar Award",
    "Frank L. Weil Memorial Quality Jewish Committee Award",
    "Frank L. Weil Memorial Unit Recognition Award",
    "George Meany Award",
    "Glenn A. and Melinda W. Adams National Eagle Scout Service Project of the Year Award",
    "Historic Trails Award",
    "International Scouter’s Award",
    "International Spirit Award",
    "Interpreter Strip Award",
    "James E. West Fellowship",
    "Journey to Excellence",
    "Kayaking BSA Award",
    "Keep America Beautiful Hometown USA Award",
    "Lifesaving and Meritorious Action Award",
    "Long Cruise Award",
    "Memorial Gold Star Award",
    "Messengers of Peace Award",
    "Mile Swim BSA Award",
    "National Duty to God Award",
    "National Honor Patrol Award",
    "National Major Gift Award",
    "National Medal for Outdoor Achievement",
    "National Outdoor Challenge Unit Award",
    "National Summertime Pack Award",
    "NESA Life Membership Award",
    "NESA Outstanding Eagle Scout Award",
    "North Star Award",
    "Nova Awards Program",
    "Order of the Arrow—Distinguished Service Award",
    "Order of the Arrow—Founder’s Award",
    "Order of the Arrow—Red Arrow Award",
    "Order of the Arrow—Vigil Honor",
    "Outdoor Ethics Awareness and Action Award",
    "Paul Bunyan Award",
    "Philmont Training Center Masters Track Award",
    "Presidents Leadership Council",
    "Professional Circle Award",
    "Professional Fellowship Honor",
    "Recruiter Strip Award",
    "Religious Emblems Awards Program",
    "iScouting…Vale la Pena! Service Award",
    "Scholarships",
    "Scouter’s Key Award",
    "Scouter’s Training Award",
    "Scuba BSA Award",
    "Sea Scout Leadership Award",
    "Second Century Society",
    "Service Stars Award",
    "Silver Antelope Award",
    "Silver Beaver Award",
    "Silver Buffalo Award",
    "Skipper’s Key Award",
    "Snorkeling BSA Award",
    "Special Needs Scouting Service Award",
    "Spirit of the Eagle Award",
    "Totin’ Chip Award",
    "Torch of Gold Award",
    "Trained Strip",
    "Unit Leader Award of Merit",
    "Venturing Leadership Award",
    "Venturing Shooting Sports Outstanding Achievement Award",
    "Veteran Award",
    "Veteran Unit Award",
    "W.P. Society Award",
    "Whitewater Rafting BSA Award",
    "Whitney M. Young Jr. Service Award",
    "Whittling Chip Award",
    "William D. Boyce New-Unit Organizer Award",
    "Winthrop Rockefeller Award",
    "World Conservation Award",
    "Woods Services Award"
];


function populateAwardsDropdown() {
    const dropdown = document.getElementById("awardDropdown");
    dropdown.innerHTML = ""; 
    awards.forEach(award => {
        const option = document.createElement("option");
        option.value = award.replace(/\s+/g, "_"); 
        option.textContent = award;
        dropdown.appendChild(option);
    });
}

function searchAwards() {
    const input = document.getElementById("awardSearchInput").value.toLowerCase();
    const options = document.querySelectorAll("#awardDropdown option");
    options.forEach(option => {
        const award = option.textContent.toLowerCase();
        if (award.includes(input)) {
            option.style.display = "block";
        } else {
            option.style.display = "none";
        }
    });
}

function searchScouts() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("#scoutsTable tr:not(:first-child)");
    rows.forEach(row => {
        const firstName = row.cells[0].textContent.toLowerCase();
        const lastName = row.cells[1].textContent.toLowerCase();
        if (firstName.includes(input) || lastName.includes(input)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

searchInput.addEventListener('keyup', searchScouts);

populateAwardsDropdown();
