import React from 'react';
import Breadcrumbs from '../components/Breadcrumbs';
import { getConferencesBySection } from '../data/mockConferences';

export default function Conferences({ onNavigateConference, onNavigate }) {
  const sections = getConferencesBySection();

  return (
    <div>
      {/* Breadcrumbs */}
      <Breadcrumbs 
        paths={[{ name: 'Conferences', target: 'conferences' }]} 
        onNavigate={onNavigate} 
      />

      <div className="article" id="maincontent" style={{ marginTop: '20px' }}>
        <article className="columns" id="SkipTarget">
          <div className="row">
            <div className="columns medium-12">
              
              <div style={{ background: '#f9f9f9', padding: '30px', borderRadius: '4px', border: '1px solid #eee', marginBottom: '30px' }}>
                <h1 style={{ fontSize: '32px', color: '#005a83', margin: '0 0 10px 0', fontWeight: 'bold' }}>
                  ACM India Conferences & Events
                </h1>
                <p style={{ fontSize: '15px', color: '#555', lineHeight: '1.6', margin: 0 }}>
                  ACM India coordinates and supports several national conferences, regional summits, and student programs that promote theoretical computer science, software engineering, women in computing, and academic curriculum modernization.
                </p>
              </div>

              <div className="articles">
                {Object.entries(sections).map(([sectionName, conferences]) => (
                  <div key={sectionName} style={{ marginBottom: '30px' }}>
                    <h2 style={{ 
                      fontSize: '22px', 
                      color: '#333', 
                      borderBottom: '2px solid #005a83', 
                      paddingBottom: '8px', 
                      marginBottom: '15px',
                      fontWeight: 'bold' 
                    }}>
                      {sectionName}
                    </h2>
                    
                    <ul style={{ listStyle: 'none', padding: 0 }}>
                      {conferences.map(conf => (
                        <li key={conf.id} style={{ 
                          padding: '15px', 
                          background: '#fff', 
                          border: '1px solid #e3e3e3', 
                          borderRadius: '4px', 
                          marginBottom: '10px',
                          boxShadow: '0 1px 3px rgba(0,0,0,0.05)',
                          transition: 'all 0.2s ease'
                        }}>
                          <a 
                            href={`#conference/${conf.slug}`}
                            onClick={(e) => { e.preventDefault(); onNavigateConference(conf.slug); }}
                            style={{ 
                              fontSize: '17px', 
                              fontWeight: 'bold', 
                              color: '#005a83', 
                              textDecoration: 'none',
                              display: 'block',
                              marginBottom: '5px'
                            }}
                          >
                            {conf.title}
                          </a>
                          <div style={{ fontSize: '12px', color: '#888', marginBottom: '8px' }}>
                            📅 {conf.date} | 📍 {conf.location}
                          </div>
                          <p style={{ fontSize: '13px', lineHeight: '1.5', color: '#555', margin: 0 }}>
                            {conf.description}
                          </p>
                        </li>
                      ))}
                    </ul>
                  </div>
                ))}
              </div>

            </div>
          </div>
        </article>
      </div>
    </div>
  );
}
