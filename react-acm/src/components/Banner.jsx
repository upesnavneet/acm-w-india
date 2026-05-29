import React from 'react';
import { mockThemeMod } from '../data/mockThemeMod';

export default function Banner({ customBanner }) {
  // Allow overriding default banner settings for sub-pages, falling back to ACM-W India defaults
  const bgImage = customBanner?.image || "/acm/img/banner.png";
  const topTitle = customBanner?.topTitle !== undefined ? customBanner.topTitle : "ACM-W India";
  const title = customBanner?.title || "Supporting, celebrating and advocating for Women in Computing";
  const description = customBanner?.description || "ACM-W India Council on Women in Computing";

  return (
    <div className="banner-container" style={{ width: '100%', overflow: 'hidden' }}>
      <section 
        className="acm-banner-container"
        style={{ 
          backgroundImage: `url('${bgImage}')`,
          backgroundSize: 'cover',
          backgroundPosition: 'center',
          position: 'relative',
          padding: '85px 0',
          color: '#fff',
          minHeight: '340px',
          display: 'flex',
          alignItems: 'center',
          fontFamily: '"Inter", "Helvetica Neue", Arial, sans-serif'
        }}
      >
        {/* Subtle dark-teal geometric gradient overlay to ensure text contrast while showing the map */}
        <div 
          className="gradient-wrapper" 
          style={{ 
            position: 'absolute', 
            top: 0, 
            left: 0, 
            right: 0, 
            bottom: 0, 
            background: 'linear-gradient(to right, rgba(0, 24, 38, 0.85) 0%, rgba(0, 47, 71, 0.4) 60%, rgba(0, 0, 0, 0.2) 100%)', 
            zIndex: 1 
          }}
        ></div>
        <div 
          className="overlay" 
          style={{ 
            position: 'absolute', 
            top: 0, 
            left: 0, 
            right: 0, 
            bottom: 0, 
            backgroundColor: 'rgba(3, 86, 75, 0.15)', 
            zIndex: 1 
          }}
        ></div>
        
        <div className="row" style={{ position: 'relative', zIndex: 2, width: '100%', maxWidth: '1200px', margin: '0 auto', padding: '0 20px' }}>
          <div className="columns large-12 medium-12 banner-content" style={{ display: 'flex', flexDirection: 'column', gap: '30px' }}>
            
            {/* Title Block */}
            <div>
              {topTitle && (
                <span 
                  style={{ 
                    display: 'block', 
                    fontSize: '18px', 
                    fontWeight: '700',
                    color: '#b9dfe9', 
                    marginBottom: '15px',
                    letterSpacing: '0.5px'
                  }}
                >
                  {topTitle}
                </span>
              )}
              <h1 
                className="banner-heading" 
                style={{ 
                  fontSize: '38px', 
                  color: '#fff', 
                  fontWeight: '700', 
                  margin: '0', 
                  lineHeight: '1.25',
                  maxWidth: '750px',
                  textShadow: '0 2px 10px rgba(0,0,0,0.3)'
                }}
              >
                {title}
              </h1>
            </div>
            
            {/* Caption Block - Positioned lower left */}
            {description && (
              <p 
                style={{ 
                  fontSize: '14px', 
                  color: '#e2e8f0',
                  fontWeight: '600',
                  margin: 0, 
                  letterSpacing: '0.2px',
                  textShadow: '0 1px 4px rgba(0,0,0,0.3)',
                  opacity: 0.95
                }}
              >
                {description}
              </p>
            )}

          </div>
        </div>
      </section>
    </div>
  );
}

