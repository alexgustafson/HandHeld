//
//  NetworkHandler.h
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 11.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "Reachability.h"

@protocol AssetDownloaderDelegate <NSObject>

-(void)startApp;

@end

@class Reachability;
@interface NetworkHandler : NSObject
{
    Reachability* wifiReachable;
    Reachability* hostReachable;
    
    BOOL wifiActive;
    BOOL hostActive;
    
    id delegate;
}

@property (nonatomic, assign) BOOL wifiActive;
@property (nonatomic, assign) BOOL hostActive;
@property (nonatomic, assign) id delegate;

- (id)initwithDelegate:(id)delegate;
- (void) checkNetworkStatus:(NSNotification *)notice;

@end
