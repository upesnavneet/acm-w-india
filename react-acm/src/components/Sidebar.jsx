import React from 'react';
import { mockPosts } from '../data/mockPosts';
import { mockConferences } from '../data/mockConferences';

export default function Sidebar({ onNavigatePost, onNavigateConference }) {
  // Get recent 2 posts
  const recentPosts = mockPosts.slice(0, 2);
  
  // Get recent 2 conferences
  const upcomingEvents = mockConferences.slice(0, 2);

  return (
    <aside id="secondary" className="columns large-3 medium-3 small-12" role="complementary" style={{ borderLeft: '1px solid #eee', paddingLeft: '20px' }}>
      
      {/* Widget 1: Upcoming Conferences */}
      <div className="widget" style={{ marginBottom: '30px' }}>
        <h3 className="widget-title" style={{ borderBottom: '2px solid #005a83', paddingBottom: '5px', fontSize: '18px', color: '#333' }}>
          Upcoming Events
        </h3>
        <ul className="upcoming-events-list" style={{ listStyle: 'none', padding: 0 }}>
          {upcomingEvents.map(event => (
            <li key={event.id} style={{ marginBottom: '15px', fontSize: '14px' }}>
              <a 
                href={`#conference/${event.slug}`} 
                onClick={(e) => { e.preventDefault(); onNavigateConference(event.slug); }}
                style={{ fontWeight: 'bold', color: '#005a83', textDecoration: 'none' }}
              >
                {event.title}
              </a>
              <div style={{ fontSize: '12px', color: '#666', marginTop: '3px' }}>
                📅 {event.date} | 📍 {event.location}
              </div>
            </li>
          ))}
        </ul>
      </div>

      {/* Widget 2: Latest News */}
      <div className="widget" style={{ marginBottom: '30px' }}>
        <h3 className="widget-title" style={{ borderBottom: '2px solid #005a83', paddingBottom: '5px', fontSize: '18px', color: '#333' }}>
          Latest News
        </h3>
        <ul className="latest-news-list" style={{ listStyle: 'none', padding: 0 }}>
          {recentPosts.map(post => (
            <li key={post.id} style={{ marginBottom: '15px', fontSize: '14px' }}>
              <a 
                href={`#post/${post.slug}`} 
                onClick={(e) => { e.preventDefault(); onNavigatePost(post.slug); }}
                style={{ fontWeight: 'bold', color: '#005a83', textDecoration: 'none' }}
              >
                {post.title}
              </a>
              <div style={{ fontSize: '12px', color: '#888', marginTop: '3px' }}>
                {post.date}
              </div>
            </li>
          ))}
        </ul>
      </div>

      {/* Widget 3: Newsletter / Call to Action */}
      <div className="widget shadowed cta" style={{ padding: '15px', background: '#f5f5f5', borderRadius: '4px', border: '1px solid #e3e3e3' }}>
        <h4 style={{ marginTop: 0, color: '#333' }}>Subscribe to ACM India</h4>
        <p style={{ fontSize: '13px', color: '#666', lineHeight: '1.4' }}>
          Get monthly updates about our activities, summer schools, and conferences directly in your inbox.
        </p>
        <form onSubmit={(e) => { e.preventDefault(); alert('Subscribed successfully!'); }} style={{ marginTop: '10px' }}>
          <input 
            type="email" 
            placeholder="Your Email Address" 
            required
            style={{ width: '100%', padding: '6px 10px', fontSize: '13px', marginBottom: '8px', border: '1px solid #ccc', borderRadius: '4px' }}
          />
          <button 
            type="submit" 
            className="button small"
            style={{ width: '100%', margin: 0, padding: '8px', background: '#005a83', color: '#fff', border: 'none', borderRadius: '4px', fontWeight: 'bold', cursor: 'pointer' }}
          >
            Subscribe
          </button>
        </form>
      </div>

    </aside>
  );
}
