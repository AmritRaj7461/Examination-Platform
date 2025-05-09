<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="output.css">
    <link rel="icon" href="Logo.png" type="image/png">
</head>
<body>
    <!-- terms and conditions page -->
    <div class="h-250 w-full flex justify-center ">
        <div class="mt-5 shadow-lg shadow-gray-500 rounded-xl h-220 w-300 bg-transparent hover:shadow-2xl">
            <h1 class="text-2xl font-bold pl-8 pt-8 pb-4">
                Terms and Conditions
            </h1>
            <div class="pl-8 pr-8 pb-8">
                <p class="text-gray-600 font-bold">
                    By using our services, you agree to the following terms and conditions. Please read them carefully.
                </p>
                <h1 class="text-xl font-semibold pt-2">
                    1. General Guidelines
                </h1>  
                <p>
                    By accessing and using our examination platform, you agree to comply with the following terms and conditions. These rules are implemented to ensure a fair and secure examination environment for all students. Any violation of these terms may result in strict disciplinary action, including disqualification from the examination.
                </p>    
                <h1 class="text-xl font-semibold pt-2">
                    2. Prohibited Activities
                </h1>
                <p>
                    To maintain the integrity of the examination, students must adhere to the following restrictions:
                    No Screen Sharing Applications: Students must not use any screen-sharing, remote access, or virtual desktop applications (e.g., AnyDesk, TeamViewer, Zoom, or Google Meet) during the examination.
                    No Unauthorized Software: Any software or tools designed to manipulate, bypass, or interfere with the security of the examination platform are strictly prohibited.
                    No Smart Wearables: Students are not allowed to wear smartwatches, fitness bands, or any other smart wearable devices during the examination.
                    No Mobile Phones or Electronic Gadgets: Carrying smartphones, tablets, or any other communication devices in the examination room is strictly forbidden.
                </p>
                <h1 class="text-xl font-semibold pt-2">
                    3. Examination Environment
                </h1>
                <p>
                    Students must ensure that they are taking the examination in a quiet and isolated environment.
                    Any background noises or disturbances may be considered as an attempt to violate examination rules.
                    The platform may monitor and track student activity through webcams, screen recording, and other monitoring tools to prevent misconduct.
                </p>
                <h1 class="text-xl font-semibold pt-2">
                    4. Consequences of Violations
                </h1>
                <p>
                    If a student is found using any restricted software or devices, immediate action will be taken, including but not limited to:
                    Termination of the ongoing examination session.
                    Disqualification from the examination.
                    Reporting the misconduct to the relevant authorities for further disciplinary actions.
                    The decision of the examination authorities will be final and binding.
                </p>
                <h1 class="text-xl font-semibold pt-2">
                    5. Acceptance of Terms
                </h1>
                <p>
                    By appearing for the examination, students acknowledge and agree to these terms and conditions. Failure to comply with any of the above rules may result in immediate disqualification and further consequences as determined by the examination authorities.
                </p>
                <h1 class="text-xl font-semibold pt-2">
                    6. Amendments
                </h1>
                <p>
                    The examination platform reserves the right to modify these terms and conditions at any time without prior notice. Students are advised to review the guidelines before appearing for any examination.
                </p>
                <form action="testingpreview.php" method="POST">
                    <!-- Checkbox and Label -->
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="T_and_C" name="T_and_C" value="T_and_C" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                        <label for="T_and_C" class="text-gray-600 font-bold">
                            I have read and agree to the 
                            <a href="#" class="text-blue-800 underline">Terms & Conditions</a> and I understand that any violation of these rules may result in disqualification and other disciplinary actions.
                        </label>
                    </div>
                    <!-- Proceed Button -->
                    <button 
                        id="proceedButton" 
                        class="mt-4 bg-blue-800 text-white rounded-xl shadow-lg shadow-gray-500 h-10 w-40 flex justify-center items-center mx-auto pt-1 hover:cursor-pointer hover:shadow-2xl disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                        Proceed
                    </button>
                </form>
                <script>
                    document.getElementById('T_and_C').addEventListener('change', function() {
                        document.getElementById('proceedButton').disabled = !this.checked;
                    });
                </script>
            </div>
        </div>
    </div>
</body>
</html>
