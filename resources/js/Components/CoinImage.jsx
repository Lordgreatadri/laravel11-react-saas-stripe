import React from 'react';

const CoinImage = () => {
    return (
        <div>
            <img 
                src="/img/coin-removebg.png" 
                alt="Coin" 
                width="20" // Specify any width and height you prefer
                height="20" 
                className='w-[20px]'
            />
        </div>
    );
}

export default CoinImage;