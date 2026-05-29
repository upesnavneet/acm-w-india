import React, { useState } from 'react';
import Banner from '../components/Banner';
import Breadcrumbs from '../components/Breadcrumbs';

export default function CustomPage({ pageId, onNavigate }) {
  const [formData, setFormData] = useState({ name: '', email: '', message: '' });
  const [submitted, setSubmitted] = useState(false);

  const handleContactSubmit = (e) => {
    e.preventDefault();
    setSubmitted(true);
    setFormData({ name: '', email: '', message: '' });
  };

  // Define contents dynamically depending on selected subpage
  let contentTitle = "";
  let contentBody = null;
  let customBanner = null;

  if (pageId === 'acm-w' || pageId === 'about') {
    customBanner = {
      image: "/stock-images/regional-councils.jpg",
      topTitle: "Fostering Regional Collaboration",
      title: "About ACM-W India",
      description: "Supporting, celebrating, and advocating internationally for the full engagement of women in all aspects of the computing field."
    };
    contentTitle = "About ACM-W India";
    contentBody = (
      <div>
        <p>ACM-W India is a regional branch of the Association for Computing Machinery's Committee on Women in Computing. We coordinate activities, celebrations, and support networks across all Indian states, serving as a hub for both academia and industry professionals.</p>
        
        <h3>Our Core Mission</h3>
        <p>We believe that computing as a science and a profession thrives when it is inclusive and diverse. Our goal is to promote the recruitment, retention, and advancement of women in computer science, software engineering, AI, and information technology by providing opportunities, visibility, and mutual support.</p>

        <h3>Key Objectives:</h3>
        <ul style={{ lineHeight: '1.7', fontSize: '14px', paddingLeft: '20px' }}>
          <li><strong>Enhance Visibility:</strong> Highlight the contributions, achievements, and leadership of women in computing across India.</li>
          <li><strong>Build Communities:</strong> Foster collaboration between regional universities, local tech hubs, and student societies through ACM-W Chapters.</li>
          <li><strong>Inspire the Next Generation:</strong> Sponsor and support local Celebrations of Women in Computing to show students the wide array of potential paths.</li>
          <li><strong>Provide Funding & Support:</strong> Facilitate travel grants, research scholarships, and networking events for early-career researchers.</li>
        </ul>
        
        <div style={{ marginTop: '30px', padding: '20px', border: '1px solid #03564b', background: '#f4faf9', borderRadius: '4px' }}>
          <h4 style={{ color: '#03564b', marginTop: 0 }}>Join the ACM-W India Executive Committee</h4>
          <p style={{ margin: 0, fontSize: '13.5px', lineHeight: '1.5' }}>
            Are you an academic, industry specialist, or community leader passionate about encouraging diversity in STEM? We are always looking for committee leaders to help guide our working groups in Communications, Events, and Chapter Development. Learn more in our <strong>Volunteers</strong> section!
          </p>
        </div>
      </div>
    );
  } else if (pageId === 'volunteers') {
    customBanner = {
      image: "/stock-images/get-involved.jpg",
      topTitle: "Make a Difference in the STEM Community",
      title: "Volunteer with ACM-W India",
      description: "Contribute your skills, collaborate with leaders across India, and inspire the next generation of technologists."
    };
    contentTitle = "Volunteer with ACM-W India";
    contentBody = (
      <div>
        <p>ACM-W India is a volunteer-led, nonprofit community. Our growth and impact are entirely driven by the dedication, talent, and energy of computer science students, academic faculty, and industry practitioners who volunteer their time.</p>
        
        <h3>Why Volunteer with Us?</h3>
        <p>Volunteering is a fantastic way to develop leadership skills, expand your technical and professional networks across India, give back to the community, and raise your global profile in the computing industry.</p>
        
        <h3>Active Working Groups:</h3>
        <div style={{ display: 'grid', gridTemplateColumns: '1fr', gap: '20px', marginTop: '15px' }}>
          <div style={{ padding: '15px', border: '1px solid #eee', borderRadius: '4px', background: '#fafafa' }}>
            <h4 style={{ color: '#00486c', marginTop: 0 }}>1. Celebrations & Events Group</h4>
            <p style={{ margin: 0, fontSize: '13.5px' }}>Help plan and coordinate regional computer science conferences, organize local hackathons, and review applications for student travel grants to major computing forums.</p>
          </div>
          <div style={{ padding: '15px', border: '1px solid #eee', borderRadius: '4px', background: '#fafafa' }}>
            <h4 style={{ color: '#00486c', marginTop: 0 }}>2. Chapters Support & Mentorship Group</h4>
            <p style={{ margin: 0, fontSize: '13.5px' }}>Guide student clubs in launching new ACM-W chapters, supply templates and material guides, and match professional mentors with graduating students.</p>
          </div>
          <div style={{ padding: '15px', border: '1px solid #eee', borderRadius: '4px', background: '#fafafa' }}>
            <h4 style={{ color: '#00486c', marginTop: 0 }}>3. Communications & Editorial Group</h4>
            <p style={{ margin: 0, fontSize: '13.5px' }}>Write member spotlights, edit monthly newsletters, manage our online social communities, or conduct interviews with prominent female computer scientists.</p>
          </div>
        </div>

        <div style={{ marginTop: '25px', padding: '15px', background: '#f5fbfe', border: '1px solid #007cc2', borderRadius: '4px' }}>
          <h4 style={{ color: '#003666', marginTop: 0 }}>Apply to Volunteer</h4>
          <p style={{ fontSize: '13.5px' }}>Ready to join a group? Submit a short application detailing your background and interest. We will pair you with a team lead within 1-2 weeks.</p>
          <button 
            className="button"
            onClick={() => onNavigate('contact')}
            style={{ padding: '8px 16px', background: '#007cc2', color: '#fff', border: 'none', borderRadius: '4px', fontWeight: 'bold' }}
          >
            Open Application Form
          </button>
        </div>
      </div>
    );
  } else if (pageId === 'chapters') {
    customBanner = {
      image: "/stock-images/acm-chapter-logo.jpg",
      topTitle: "Connecting Local Communities",
      title: "ACM-W Indian Chapters",
      description: "Creating spaces for collaboration, mentorship, and professional growth in universities and cities across India."
    };
    contentTitle = "ACM-W Indian Chapters Network";
    contentBody = (
      <div>
        <p>An ACM-W Chapter is a local pocket of computing excellence. Established at a university or within a metropolitan area, chapters bring together students, faculty, and professional developers to network, run workshops, and share experiences.</p>
        
        <h3>Why Establish an ACM-W Chapter?</h3>
        <p>Active chapters gain access to global ACM resources, distinguished lecture sponsorships, student scholarship applications, and direct funding to host regional community events.</p>

        <h3>How to Start a Student or Professional Chapter:</h3>
        <ol style={{ lineHeight: '1.8', fontSize: '14px', paddingLeft: '20px', marginBottom: '25px' }}>
          <li>Assemble a team of at least <strong>10 active ACM members</strong> (students or professionals).</li>
          <li>Designate a <strong>Faculty Sponsor</strong> (for university student chapters) or an Executive Chair (for professional chapters).</li>
          <li>Draft a basic constitution outlining your local leadership and focus areas.</li>
          <li>Submit a simple charter application through the official ACM Chapter dashboard.</li>
        </ol>

        <div style={{ display: 'flex', flexWrap: 'wrap', gap: '15px', background: '#fafafa', padding: '15px', border: '1px solid #eee', borderRadius: '4px' }}>
          <div style={{ flex: '1 1 200px' }}>
            <h4 style={{ color: '#03564b', marginTop: 0 }}>Chapter Starter Kit</h4>
            <p style={{ fontSize: '13px', margin: 0 }}>Get our comprehensive PDF guide filled with workshop structures, sample event templates, funding request sheets, and recruiting ideas.</p>
          </div>
          <div style={{ display: 'flex', alignItems: 'center' }}>
            <a 
              href="#contact" 
              onClick={(e) => { e.preventDefault(); onNavigate('contact'); }}
              className="button" 
              style={{ padding: '10px 18px', background: '#03564b', color: '#fff', fontWeight: 'bold', borderRadius: '4px', margin: 0 }}
            >
              Request Starter Kit
            </a>
          </div>
        </div>
      </div>
    );
  } else if (pageId === 'celebrations') {
    customBanner = {
      image: "/stock-images/acm-students.jpg",
      topTitle: "Shining a Spotlight on Innovation",
      title: "ACM-W India Celebrations",
      description: "Connecting, inspiring, and showcasing technical achievements at our regional student events and hackathons."
    };
    contentTitle = "Celebrations of Women in Computing";
    contentBody = (
      <div>
        <p>ACM-W India Celebrations are low-cost, high-impact regional conferences that connect students and professional women. These events offer opportunities for research presentations, panel discussions on career advancement, career fairs, and networking with peers and mentors.</p>
        
        <h3>A Glimpse into Our Celebrations:</h3>
        <ul style={{ lineHeight: '1.7', fontSize: '14px', paddingLeft: '20px', marginBottom: '25px' }}>
          <li><strong>WomENcourage:</strong> Our flagship annual Indian event featuring technical research posters, intensive hackathons, industry networking sessions, and career workshops.</li>
          <li><strong>National CS Forums:</strong> Localized academic gatherings highlighting national female research leaders in AI and CyberSecurity.</li>
          <li><strong>Graduate Showcases:</strong> Mentored platforms enabling PhD and Masters candidates to obtain constructive feedback on their theses from industry professionals.</li>
        </ul>

        <div style={{ padding: '20px', background: '#f5fbfe', border: '1px solid #007cc2', borderRadius: '4px' }}>
          <h4 style={{ color: '#003666', marginTop: 0 }}>Apply for a Travel Grant</h4>
          <p style={{ fontSize: '13.5px', lineHeight: '1.5' }}>
            Are you a student wishing to attend the next womENcourage Celebration? We offer generous travel grants covering ticket prices, accommodation, and travel expenses to help you participate. Applications open in February every year.
          </p>
        </div>
      </div>
    );
  } else if (pageId === 'newsletter') {
    customBanner = {
      image: "/stock-images/complexity.jpg",
      topTitle: "Stay Up to Date with Our Community",
      title: "ACM-W India Monthly Newsletter",
      description: "Read member spotlights, track upcoming events, review scholarship opportunities, and follow technology trends."
    };
    contentTitle = "Subscribe & Read Our Newsletter";
    contentBody = (
      <div>
        <p>Our monthly newsletter keeps the Indian community connected. It showcases chapter reports, details regional celebrations, features interviews with leading tech figures, and shares current funding and career options.</p>
        
        <h3>Subscribe to Our Mailing List</h3>
        {submitted ? (
          <div style={{ background: '#d4edda', color: '#155724', padding: '15px', borderRadius: '4px', border: '1px solid #c3e6cb', marginBottom: '20px' }}>
            <strong>Thank you for subscribing!</strong> You will receive our next monthly issue in your inbox.
          </div>
        ) : (
          <form onSubmit={handleContactSubmit} style={{ background: '#fcfcfc', border: '1px solid #eee', padding: '18px', borderRadius: '4px', marginBottom: '25px' }}>
            <div style={{ display: 'flex', flexWrap: 'wrap', gap: '10px' }}>
              <input 
                type="email" 
                placeholder="Enter your email address..." 
                required 
                value={formData.email}
                onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                style={{ flex: '1 1 250px', padding: '8px 12px', border: '1px solid #ccc', borderRadius: '4px', margin: 0 }}
              />
              <button 
                type="submit" 
                className="button"
                style={{ padding: '8px 20px', background: '#03564b', color: '#fff', border: 'none', borderRadius: '4px', fontWeight: 'bold', cursor: 'pointer', margin: 0 }}
              >
                Subscribe Now
              </button>
            </div>
          </form>
        )}

        <h3>Recent Newsletter Issues:</h3>
        <ul style={{ listStyle: 'none', padding: 0 }}>
          <li style={{ padding: '12px', borderBottom: '1px solid #eee' }}>
            <a href="#newsletter" style={{ color: '#00486c', fontWeight: 'bold', textDecoration: 'none' }}>ACM-W India Newsletter - May 2026</a>
            <div style={{ fontSize: '12px', color: '#666' }}>Highlights: WomENcourage 2026 Registration Open, Interview with Dr. Elena Rossi, Chapter Spotlights.</div>
          </li>
          <li style={{ padding: '12px', borderBottom: '1px solid #eee' }}>
            <a href="#newsletter" style={{ color: '#00486c', fontWeight: 'bold', textDecoration: 'none' }}>ACM-W India Newsletter - April 2026</a>
            <div style={{ fontSize: '12px', color: '#666' }}>Highlights: Research Grants Winners Announced, AI Ethics Seminar Recaps, Establishing New Chapters.</div>
          </li>
          <li style={{ padding: '12px', borderBottom: '1px solid #eee' }}>
            <a href="#newsletter" style={{ color: '#00486c', fontWeight: 'bold', textDecoration: 'none' }}>ACM-W India Newsletter - March 2026</a>
            <div style={{ fontSize: '12px', color: '#666' }}>Highlights: Ada Lovelace Memorial Day Events, Summer Coding Camp Details, Open Positions on Executive Committee.</div>
          </li>
        </ul>
      </div>
    );
  } else if (pageId === 'blog') {
    customBanner = {
      image: "/stock-images/acm-dl.jpg",
      topTitle: "Stories, Ideas & Conversations",
      title: "ACM-W India Community Blog",
      description: "Explore tech insights, professional development guides, and spotlight interviews with women in computing."
    };
    contentTitle = "ACM-W India Community Blog";
    contentBody = (
      <div>
        <p>Welcome to our community blog, a space dedicated to sharing advice, professional success guidelines, technical insights, and personal stories from women in the technology sectors across India.</p>
        
        <div style={{ display: 'flex', flexDirection: 'column', gap: '25px', marginTop: '20px' }}>
          <div style={{ padding: '20px', border: '1px solid #eee', borderRadius: '4px', background: '#fafafa' }}>
            <span style={{ fontSize: '12px', color: '#888' }}>📅 May 15, 2026 | ✍️ by Dr. Sarah Jenkins</span>
            <h4 style={{ color: '#00486c', margin: '5px 0 10px 0' }}>The Evolution of Machine Learning in Indian Health Tech</h4>
            <p style={{ margin: 0, fontSize: '13.5px', lineHeight: '1.6' }}>How advanced neural networks are shifting clinical operations, and the vital role female lead scientists are playing in shaping algorithmic transparency policies...</p>
          </div>

          <div style={{ padding: '20px', border: '1px solid #eee', borderRadius: '4px', background: '#fafafa' }}>
            <span style={{ fontSize: '12px', color: '#888' }}>📅 April 28, 2026 | ✍️ by Chloe Dubois</span>
            <h4 style={{ color: '#00486c', margin: '5px 0 10px 0' }}>Navigating the Move from Academia to Industry</h4>
            <p style={{ margin: 0, fontSize: '13.5px', lineHeight: '1.6' }}>Reflections and practical guidelines for graduating computer science students transitioning into full-time software engineering roles at major Indian tech firms...</p>
          </div>

          <div style={{ padding: '20px', border: '1px solid #eee', borderRadius: '4px', background: '#fafafa' }}>
            <span style={{ fontSize: '12px', color: '#888' }}>📅 March 12, 2026 | ✍️ by Marie Kovářová</span>
            <h4 style={{ color: '#00486c', margin: '5px 0 10px 0' }}>Building a High-Growth ACM-W Student Chapter from Scratch</h4>
            <p style={{ margin: 0, fontSize: '13.5px', lineHeight: '1.6' }}>A detailed breakdown of how we scaled our Student Chapter from 5 members to over 120 in a single academic year, hosting hackathons and technical bootcamps...</p>
          </div>
        </div>
      </div>
    );
  } else if (pageId === 'get-involved') {
    customBanner = {
      image: "/stock-images/get-involved.jpg",
      topTitle: "Build the Future of Computing",
      title: "Get Involved with ACM-W India",
      description: "Become a member, establish a local student chapter in your university, or lead computing initiatives in your region."
    };
    contentTitle = "Join the ACM-W India Community";
    contentBody = (
      <div>
        <p>ACM-W India is a volunteer-led regional branch of ACM. Our impact is driven by active students, educators, and industry professionals who contribute their time, skills, and networks to promote computing excellence and diversity.</p>
        
        <h3>Ways to Participate:</h3>
        
        <div style={{ marginBottom: '20px' }}>
          <h4 style={{ color: '#00486c', margin: '0 0 5px 0' }}>1. Launch a Student Chapter</h4>
          <p style={{ margin: 0, fontSize: '14px', lineHeight: '1.5' }}>
            Student chapters offer computer science departments an incredible opportunity to host code camps, hackathons, and distinguish lectures. Creating a chapter requires a sponsor faculty member and 10 student members.
          </p>
        </div>

        <div style={{ marginBottom: '20px' }}>
          <h4 style={{ color: '#00486c', margin: '0 0 5px 0' }}>2. Attend Regional Celebrations</h4>
          <p style={{ margin: 0, fontSize: '14px', lineHeight: '1.5' }}>
            Participate in our national Celebrations of Women in Computing and flagship annual event, <strong>womENcourage</strong>, to show research poster submissions, meet recruiters, and collaborate.
          </p>
        </div>

        <div style={{ marginBottom: '20px' }}>
          <h4 style={{ color: '#00486c', margin: '0 0 5px 0' }}>3. Apply to Volunteer with Committees</h4>
          <p style={{ margin: 0, fontSize: '14px', lineHeight: '1.5' }}>
            Work alongside computing veterans to design regional workshops, publish monthly newsletter spotlights, coordinate travel grant applications, and guide local chapter chairs.
          </p>
        </div>
      </div>
    );
  } else if (pageId === 'contact') {
    customBanner = {
      image: "/stock-images/regional-councils.jpg",
      topTitle: "Connect With Our Network",
      title: "Contact ACM-W India",
      description: "Have questions about chapter registrations, celebrations, travel grants, or volunteering? Let us know!"
    };
    contentTitle = "Contact ACM-W India";
    contentBody = (
      <div>
        <p>Have questions about chapter registrations, upcoming Celebrations, student travel grants, volunteering, or partnership options? Get in touch with our communications helpdesk. Fill out the contact form below and we will get back to you shortly.</p>
        
        {submitted ? (
          <div style={{ background: '#d4edda', color: '#155724', padding: '15px', borderRadius: '4px', border: '1px solid #c3e6cb', marginBottom: '20px' }}>
            <strong>Thank you for contacting us!</strong> Your message has been sent successfully. We will get in touch with you as soon as possible.
          </div>
        ) : (
          <form onSubmit={handleContactSubmit} style={{ background: '#fcfcfc', border: '1px solid #eee', padding: '20px', borderRadius: '4px', marginTop: '20px' }}>
            <div style={{ marginBottom: '12px' }}>
              <label style={{ display: 'block', fontSize: '12px', fontWeight: 'bold', color: '#666', marginBottom: '3px' }}>Full Name *</label>
              <input 
                type="text" 
                required 
                value={formData.name}
                onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                style={{ width: '100%', padding: '8px 10px', fontSize: '13px', border: '1px solid #ccc', borderRadius: '4px' }}
              />
            </div>
            <div style={{ marginBottom: '12px' }}>
              <label style={{ display: 'block', fontSize: '12px', fontWeight: 'bold', color: '#666', marginBottom: '3px' }}>Email Address *</label>
              <input 
                type="email" 
                required 
                value={formData.email}
                onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                style={{ width: '100%', padding: '8px 10px', fontSize: '13px', border: '1px solid #ccc', borderRadius: '4px' }}
              />
            </div>
            <div style={{ marginBottom: '15px' }}>
              <label style={{ display: 'block', fontSize: '12px', fontWeight: 'bold', color: '#666', marginBottom: '3px' }}>Your Message *</label>
              <textarea 
                rows="4" 
                required
                value={formData.message}
                onChange={(e) => setFormData({ ...formData, message: e.target.value })}
                style={{ width: '100%', padding: '8px 10px', fontSize: '13px', border: '1px solid #ccc', borderRadius: '4px', resize: 'vertical' }}
              />
            </div>
            <div>
              <button 
                type="submit" 
                className="button"
                style={{ padding: '10px 24px', background: '#03564b', color: '#fff', border: 'none', borderRadius: '4px', fontWeight: 'bold', cursor: 'pointer' }}
              >
                Send Message
              </button>
            </div>
          </form>
        )}
      </div>
    );
  } else {
    contentTitle = "Page Not Found";
    contentBody = <p>The requested page could not be located.</p>;
  }

  return (
    <div>
      {/* Banner */}
      <Banner customBanner={customBanner} />

      {/* Breadcrumbs */}
      <Breadcrumbs 
        paths={[{ name: contentTitle, target: pageId }]} 
        onNavigate={onNavigate} 
      />

      {/* Main Layout Grid */}
      <div id="maincontent" className="row" style={{ marginTop: '20px' }}>
        <div className="columns column--up">
          <div className="row">
            
            {/* Page Content column */}
            <article className="has-edit-button columns large-8 medium-8 small-12 zone-1" id="SkipTarget" tabIndex="-1">
              <section style={{ paddingRight: '20px' }}>
                <h1 style={{ fontSize: '28px', color: '#333', borderBottom: '1px solid #ddd', paddingBottom: '10px', marginBottom: '20px', fontWeight: 'bold' }}>
                  {contentTitle}
                </h1>
                <div className="post">
                  <div className="entrytext" style={{ fontSize: '15px', lineHeight: '1.7', color: '#444' }}>
                    {contentBody}
                  </div>
                </div>
              </section>
            </article>

            {/* Sidebar Widget column */}
            <aside className="columns large-4 medium-4 small-12" role="complementary" style={{ borderLeft: '1px solid #eee', paddingLeft: '20px' }}>
              <div className="widget" style={{ marginBottom: '30px' }}>
                <h3 className="widget-title" style={{ borderBottom: '2px solid #03564b', paddingBottom: '5px', fontSize: '18px', color: '#333', marginTop: 0 }}>
                  Contact Information
                </h3>
                <p style={{ fontSize: '13px', color: '#666', lineHeight: '1.6' }}>
                  📧 <strong>General Support:</strong> acmwe_help@acm.org<br />
                  🏢 <strong>Office:</strong> ACM India Council, Pune
                </p>
              </div>
              <div className="widget">
                <button 
                  className="button"
                  onClick={() => onNavigate('conferences')}
                  style={{ width: '100%', padding: '10px', background: '#03564b', color: '#fff', border: 'none', borderRadius: '4px', fontWeight: 'bold' }}
                >
                  Explore Conferences
                </button>
              </div>
            </aside>

          </div>
        </div>
      </div>
    </div>
  );
}
