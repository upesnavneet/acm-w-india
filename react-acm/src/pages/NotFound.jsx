import React from 'react';
import Breadcrumbs from '../components/Breadcrumbs';

export default function NotFound({ onNavigate }) {
  return (
    <div>
      <Breadcrumbs paths={[{ name: 'Page Not Found', target: '404' }]} onNavigate={onNavigate} />
      
      <div className="row" style={{ padding: '60px 15px', textAlign: 'center' }}>
        <h1 style={{ fontSize: '72px', color: '#cc0000', margin: '0 0 10px 0', fontWeight: 'bold' }}>404</h1>
        <h2 style={{ fontSize: '28px', color: '#333', marginBottom: '20px' }}>Oops! Page Not Found</h2>
        <p style={{ fontSize: '15px', color: '#666', maxWidth: '600px', margin: '0 auto 30px auto', lineHeight: '1.6' }}>
          We are sorry, but the page you are looking for might have been removed, had its name changed, or is temporarily unavailable. 
          Please try searching or navigate back to the homepage.
        </p>
        <button 
          className="button"
          onClick={() => onNavigate('home')}
          style={{ padding: '12px 30px', background: '#005a83', color: '#fff', border: 'none', borderRadius: '4px', fontWeight: 'bold', fontSize: '15px', cursor: 'pointer' }}
        >
          Go Back Home
        </button>
      </div>
    </div>
  );
}
