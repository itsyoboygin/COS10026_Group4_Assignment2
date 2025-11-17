<?php 
    $pageTitle = "About Us";
    include 'header.inc';
    include 'nav.inc';
?>

<body>
    <main>
        <section id="group-details">
            <h2>Group and Course Details</h2>
            
            <ul>
                <li><strong>Course:</strong> COS10026 Web Technology - Project Part 1</li>
                <li><strong>Group Name:</strong> Hi-Low</li>
                <li>
                    <strong>Class & Schedule:</strong>
                    <ul> 
                        <li><strong>Day & Time:</strong> Friday 2-5 PM</li>
                        <li><strong>Tutor's Name:</strong> Nguyen Thuy Linh</li>
                        <li>
                            <strong>Student IDs:</strong>
                            <ol> 
                                <li>105681112 (Le Thanh Dat)</li>
                                <li>106216078 (Nguyen Nhu Tuan Long)</li>
                                <li>103847381 (Do Vu Bao Phuc)</li>
                            </ol>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>

        <section id="contributions">
            <h2>Members Contribution to Project 1</h2>
            
            <ul>
                <li>
                    <p><strong>Le Thanh Dat - 105681112 (dropped):</strong></p>
                    <ul>
                        <li>Group Leader, Project Coordinator, Home page and submissions.</li>
                    </ul>
                </li>
                <li>
                    <p><strong>Nguyen Nhu Tuan Long - 106216078:</strong></p>
                    <ul>
                        <li>Quality Controller, Job description page, Group details page, and Discussion board questions.</li>
                        <li>Inc. files, login and manager portal pages, <strong>user</strong> and <strong>jobs</strong> tables for Login and Job Description Pages.</li>
                    </ul>
                </li>
                <li>
                    <p><strong>Do Vu Bao Phuc - 103847381:</strong></p>
                    <ul>
                        <li>Project Designer, Job Application Page, Question Poster.</li>
                        <li>process_eoi.php and EOI table; HR Manager Queries Portal, manage.php.  </li>
                        <li>Tables and data setup in settings.php.</li>
                    </ul>
                </li>
            </ul>
        </section>
        
        <section id="group-photo">
            <h2>Our Team Photo</h2>
            <figure>
                <img src="../styles/images/group.jpg" alt="Group Hi-Low team photo for COS10026 Web Technology class." class="about-image">
                <figcaption>Group Hi-Low: Working collaboratively to deliver the COS10026 Web Technology project.</figcaption>
            </figure>
        </section>
        
        <section id="interests">
            <h2>Members' Interests and Technical Profile</h2>
            
            <table id="interests-table">
                <caption>A profile of Group Hi-Low members' skills, hometowns, and personal interests.</caption>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Hometown</th>
                        <th>Favorite Film/Genre</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Le Thanh Dat</td>
                        <td>Thai Binh</td>
                        <td>Inception (Sci-Fi)</td>
                    </tr>
                    <tr>
                        <td>Nguyen Nhu Tuan Long</td>
                        <td>Bac Ninh</td>
                        <td>Lord of the Rings</td>
                    </tr>
                    <tr>
                        <td>Do Vu Bao Phuc</td>
                        <td>Ha Noi</td>
                        <td>Parasite</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

<?php include 'footer.inc'; ?>

</body>
</html>