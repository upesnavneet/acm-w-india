export const mockConferences = [
  {
    id: 101,
    title: "ACM India Annual Event 2026",
    slug: "acm-india-annual-event-2026",
    section: "National Conferences",
    date: "February 13-15, 2026",
    location: "IISER Pune, Maharashtra",
    description: "The flagship event of ACM India, featuring presentations by Turing Award winners, computer science researchers, and tech industry executives.",
    content: `
      <p>The ACM India Annual Event is the premier computing meeting in the country. It serves as a platform for professionals, researchers, educators, and student chapter leaders to interact with leading global scientists and discuss current computing challenges.</p>
      
      <h3>Key Event Features:</h3>
      <ul>
        <li><strong>Turing Lecture:</strong> A special virtual keynote address by a recipient of the ACM A.M. Turing Award.</li>
        <li><strong>Doctoral Dissertation Award (DDA):</strong> Recognising the most outstanding PhD dissertations in computer science and engineering across India.</li>
        <li><strong>ACM India Student Chapter Awards:</strong> Prizes awarded to student chapters for outstanding community service, coding programs, and growth.</li>
      </ul>
      
      <h3>Registration & Venue Details:</h3>
      <p>The event is hosted at the Indian Institute of Science Education and Research (IISER) Pune. Early bird registration begins in November. Accommodation is available in the university guesthouse on a first-come, first-served basis.</p>
    `
  },
  {
    id: 102,
    title: "Compute 2026: Educational Technology Symposia",
    slug: "compute-2026-educational-technology-symposia",
    section: "National Conferences",
    date: "October 22-24, 2026",
    location: "VIT Vellore, Tamil Nadu",
    description: "ACM India's annual conference focusing on improving the quality of computer science education in engineering departments.",
    content: `
      <p>Compute is the annual national conference of the ACM India Council dedicated specifically to computer science education. It acts as an interactive platform for high-quality pedagogical research and academic syllabus modernization.</p>
      
      <h3>Symposia Tracks:</h3>
      <ul>
        <li><strong>Pedagogy in Programming:</strong> Best practices in introductory CS courses and automated code assessment tools.</li>
        <li><strong>Curriculum Restructuring:</strong> Aligning Indian engineering curricula with IEEE/ACM international curriculum guidelines.</li>
        <li><strong>Diversity in CS Education:</strong> Promoting initiatives to increase representation of female and underprivileged students in technical degrees.</li>
      </ul>
      
      <h3>Call for Papers:</h3>
      <p>Academic faculty and educational researchers are invited to submit peer-reviewed papers under the primary tracks. All accepted papers will be published in the ACM International Conference Proceedings Series (ICPS) and indexed in the ACM Digital Library.</p>
    `
  },
  {
    id: 103,
    title: "ACM-W India National Graduate Research Symposium 2026",
    slug: "acm-w-india-national-grs-2026",
    section: "Regional Councils",
    date: "September 18-19, 2026",
    location: "PES University, Bengaluru",
    description: "A prestigious forum for female graduate and doctoral students to showcase computational models, receive feedback, and win travel grants.",
    content: `
      <p>The ACM-W India National Graduate Research Symposium (GRS) is designed to provide feedback and mentorship to female students pursuing graduate studies (M.Tech/M.S./PhD) in computing disciplines.</p>
      
      <h3>Key Program Elements:</h3>
      <ul>
        <li><strong>Poster Showcase:</strong> An open session where researchers display visual computational graphs and discuss their work one-on-one with attendees.</li>
        <li><strong>Panel Discussion:</strong> "Transitioning from Graduate School to Corporate Research Labs" featuring senior scientists from Google, Microsoft, and IBM Research.</li>
        <li><strong>One-on-One Mentoring:</strong> Registered students are matched with an academic mentor to discuss research directions, publication strategies, and doctoral dissertations.</li>
      </ul>
      
      <p>Travel grants are available to cover train fare and shared campus accommodation for all students whose abstracts are accepted for presentation.</p>
    `
  },
  {
    id: 104,
    title: "ACM India Student ACM Chapter Summit",
    slug: "acm-india-student-chapter-summit-2026",
    section: "Student Chapters Support",
    date: "July 10-11, 2026",
    location: "IIT Delhi, New Delhi",
    description: "A collaborative gathering for student chapter leaders to share community outreach strategies, coding camps, and technical hackathon organization.",
    content: `
      <p>Student chapters are the foundation of ACM India's community. This summit brings student leaders, chapter sponsors, and council members together to share event ideas, discuss leadership, and build networks.</p>
      
      <h3>Interactive Panels & Workshops:</h3>
      <ul>
        <li><strong>Hosting Dynamic Code Camps:</strong> Practical tips for conducting weekend programming bootcamps and algorithmic contests.</li>
        <li><strong>Collaborative Research Groups:</strong> How to form peer groups within chapters to study advanced technical publications from the ACM Digital Library.</li>
        <li><strong>Fostering Diversity:</strong> Building local ACM-W groups to support women in technology and promote computational science in schools.</li>
      </ul>
      
      <p>Each active student chapter is eligible to send up to two student representatives. ACM India covers the registration fee and meals during the two-day summit.</p>
    `
  }
];

export function getConferencesBySection() {
  return mockConferences.reduce((acc, conf) => {
    if (!acc[conf.section]) {
      acc[conf.section] = [];
    }
    acc[conf.section].push(conf);
    return acc;
  }, {});
}
