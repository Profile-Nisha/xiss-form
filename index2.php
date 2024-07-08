 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>multiple-form</title>
 </head>
 <body>
 <div class="form-section">
                <h3>(B) Details of Work Experience, if any: *</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Organization *</th>
                            <th>Position Held *</th>
                            <th>Period (From) *</th>
                            <th>Period (To) *</th>
                            <th>Responsibilities *</th>
                        </tr>
                    </thead>
                    <tbody id="work-experience">
                        <tr>
                            <td><input type="text" name="organization[]" required></td>
                            <td><input type="text" name="position[]" required></td>
                            <td><input type="date" name="period_from[]" required></td>
                            <td><input type="date" name="period_to[]" required></td>
                            <td><input type="text" name="responsibilities[]" required></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" onclick="addWorkExperienceRow()">Add More</button>
            </div>
 </body>
 </html>