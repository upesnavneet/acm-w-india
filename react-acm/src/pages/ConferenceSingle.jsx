import React from 'react';
import Breadcrumbs from '../components/Breadcrumbs';
import CommentsSection from '../components/CommentsSection';
import { mockConferences } from '../data/mockConferences';

export default function ConferenceSingle({ slug, onNavigate, onNavigateConference }) {
  // Find matching conference
  const conference = mockConferences.find(c => c.slug === slug);

  if (!conference) {
    return (
      <div className="row" style={{ padding: '40px 15px', textAlign: 'center' }}>
        <h2>Conference Not Found</h2>
        <p>The requested event could not be found.</p>
        <button className="button" onClick={() => onNavigate('conferences')}>Back to Conferences</button>
      </div>
    );
  }

  return (
    <div>
      {/* Breadcrumbs */}
      <Breadcrumbs 
        paths={[
          { name: 'Conferences', target: 'conferences' },
          { name: conference.title, target: `conference/${conference.slug}` }
        ]} 
        onNavigate={onNavigate} 
      />

      <div id="maincontent" className="article row" tabIndex="-1" style={{ marginTop: '20px' }}>
        <div className="columns">
          <div className="row">
            
            {/* Single Conference Post details */}
            <article className="columns large-9 medium-9 small-12 blocks has-edit-button" id="SkipTarget">
              <span style={{ 
                background: '#e1f0f4', 
                color: '#005a83', 
                padding: '4px 8px', 
                fontSize: '11px', 
                fontWeight: 'bold', 
                textTransform: 'uppercase', 
                borderRadius: '4px',
                display: 'inline-block',
                marginBottom: '10px'
              }}>
                {conference.section}
              </span>
              
              <h1 style={{ fontSize: '32px', color: '#333', fontWeight: 'bold', margin: '0 0 10px 0', borderBottom: '1px solid #ddd', paddingBottom: '10px' }}>
                {conference.title}
              </h1>

              {/* Event Metadata Card */}
              <div style={{ background: '#f5f5f5', padding: '15px', borderRadius: '4px', border: '1px solid #e3e3e3', margin: '20px 0', fontSize: '14px' }}>
                <div>📅 <strong>Date:</strong> {conference.date}</div>
                <div style={{ marginTop: '5px' }}>📍 <strong>Location:</strong> {conference.location}</div>
              </div>

              {/* Conference Body HTML text content */}
              <section 
                className="entry-content"
                dangerouslySetInnerHTML={{ __html: conference.content }}
                style={{ fontSize: '15px', lineHeight: '1.7', color: '#444' }}
              />

              {/* Comments/Feedback Form Section */}
              <CommentsSection targetId={conference.id} />

            </article>

            {/* Side Menu for Quick Jumps */}
            <aside className="columns large-3 medium-3 show-for-medium-up" style={{ paddingLeft: '20px', borderLeft: '1px solid #eee' }}>
              <div className="widget">
                <h3 className="widget-title" style={{ borderBottom: '2px solid #005a83', paddingBottom: '5px', fontSize: '18px', color: '#333', marginTop: 0 }}>
                  Other Conferences
                </h3>
                <ul style={{ listStyle: 'none', padding: 0 }}>
                  {mockConferences.filter(c => c.slug !== slug).map(c => (
                    <li key={c.id} style={{ marginBottom: '10px', fontSize: '13px' }}>
                      <a 
                        href={`#conference/${c.slug}`}
                        onClick={(e) => { e.preventDefault(); onNavigateConference(c.slug); }}
                        style={{ color: '#005a83', textDecoration: 'none', fontWeight: 'bold' }}
                      >
                        {c.title}
                      </a>
                    </li>
                  ))}
                </ul>
              </div>
            </aside>

          </div>
        </div>
      </div>
    </div>
  );
}
